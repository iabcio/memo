linux最大线程数限制
研发环境上的Linux项目启动报错：Caused by: java.lang.OutOfMemoryError: unable to create new native thread
开始以为是内存不足导致无法创建线程，把jvm的-Xms，-Xmx的2个参数都加大一倍：-Xms2048m -Xmx2048m。把-Xss参数调小，还是启动失败。应该是系统方面的限制了，这台机器上搞了100个过tomcat进程，还有不少其他软件，东西比较多且杂。确认过机器的内存还是足够的，先排查系统参数，之后再清理垃圾资源了。
系统可生成最大线程数

cat /proc/sys/kernel/threads-max
这个值很大，tomcat进程的全部线程数肯定没有超过它，如果实际线程数比它大可改大（实际可能是代码问题，开启了太多线程）。
进程最大线程数

ps -eLf | grep 项目名 | wc -l 查看单个项目线程数，启动失败的这个项目线程数一般在600左右
cat /proc/sys/vm/max_map_count
65530
这个值没有问题，jvm的启动参数为-Dconfig.server.maxThreads=3000，也没有问题
用户最大进程数

ulimit -a
其中max user processes就是表示用户的最大进程数，我的这个值很大，进程数也没有超过它。如果超过的话，可以修改最大进程数的配置
vi /etc/security/limits.d/90-nproc.conf
* soft nproc 1024
root soft nproc unlimited
上面可以看除了root用户外的所有用户均限制为1024，因此通过可以注释此行或者将值改大，保存后修改立刻生效
#* soft nproc 1024
root soft nproc unlimited
整个系统已用的线程或进程数


cat /proc/sys/kernel/pid_max
该值是32678（32位Linux系统可创建的最大pid数是32678），查询当前整个系统已用的线程或进程数：pstree -p | wc -l，结果比32678稍小，问题就在这了

vim /proc/sys/kernel/pid_max,改为65535保存退出的时候报错如下
/proc/sys/kernel/pid_max E667 Fsync failed
改成下面方式即可：
echo "65535" > /proc/sys/kernel/pid_max
不需要重启，保存后立刻生效，重启项目终于好了

