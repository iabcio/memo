Mac home 目录下创建文件夹

example:

sudo vim /etc/auto_master
before:
# Automounter master map
+auto_master            # Use directory service
/net                    -hosts          -nobrowse,hidefromfinder,nosuid
/home                   auto_home       -nobrowse,hidefromfinder
/Network/Servers        -fstab
/-                      -static
after:
# Automounter master map
+auto_master            # Use directory service
/net                    -hosts          -nobrowse,hidefromfinder,nosuid
#/home                   auto_home       -nobrowse,hidefromfinder
/Network/Servers        -fstab
/-                      -static
to have the change take effect without a reboot:
cd / (这一步很重要)

sudo automount（必须在/目录下执行）
mkdir /home/test

ls -l /home/

total 0

drwxr-xr-x 3 root admin 102 Aug 10 11:33 test

