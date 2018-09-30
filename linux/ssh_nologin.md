本文基于实际Linux管理工作，实例讲解工作中使用ssh证书登录的实际流程，讲解ssh证书登录的配置原理，基于配置原理，解决实际工作中，windows下使用SecureCRT证书登录的各种问题，以及实现hadoop集群部署要求的无密码跳转问题。
ssh有密码登录和证书登录，初学者都喜欢用密码登录，甚至是root账户登录，密码是123456。但是在实际工作中，尤其是互联网公司，基本都 是证书登录的。内网的机器有可能是通过密码登录的，但在外网的机器，如果是密码登录，很容易受到攻击，真正的生产环境中，ssh登录都是证书登录。
证书登录的步骤

1.客户端生成证书:私钥和公钥，然后私钥放在客户端，妥当保存，一般为了安全，访问有黑客拷贝客户端的私钥，客户端在生成私钥时，会设置一个密 码，以后每次登录ssh服务器时，客户端都要输入密码解开私钥(如果工作中，你使用了一个没有密码的私钥，有一天服务器被黑了，你是跳到黄河都洗不清)。
2.服务器添加信用公钥：把客户端生成的公钥，上传到ssh服务器，添加到指定的文件中，这样，就完成ssh证书登录的配置了。
假设客户端想通过私钥要登录其他ssh服务器，同理，可以把公钥上传到其他ssh服务器。
真实的工作中:员工生成好私钥和公钥(千万要记得设置私钥密码)，然后把公钥发给运维人员，运维人员会登记你的公钥，为你开通一台或者多台服务器的 权限，然后员工就可以通过一个私钥，登录他有权限的服务器做系统维护等工作，所以，员工是有责任保护他的私钥的，如果被别人恶意拷贝，你又没有设置私钥密 码，那么，服务器就全完了，员工也可以放长假了。
客户端建立私钥和公钥

在客户端终端运行命令

ssh-keygen -t rsa
rsa是一种密码算法，还有一种是dsa，证书登录常用的是rsa。
假设用户是blue,执行 ssh-keygen 时，才会在我的home目录底下的 .ssh/ 这个目录里面产生所需要的两把 Keys ，分别是私钥 (id_rsa) 与公钥 (id_rsa.pub)。
另外就是私钥的密码了，如果不是测试，不是要求无密码ssh，那么对于passphrase，不能输入空(直接回车),要妥当想一个有特殊字符的密码。
ssh服务端配置

ssh服务器配置如下:


vim /etc/ssh/sshd_config
#禁用root账户登录，非必要，但为了安全性，请配置
PermitRootLogin no

# 是否让 sshd 去检查用户家目录或相关档案的权限数据，
# 这是为了担心使用者将某些重要档案的权限设错，可能会导致一些问题所致。
# 例如使用者的 ~.ssh/ 权限设错时，某些特殊情况下会不许用户登入
StrictModes no

# 是否允许用户自行使用成对的密钥系统进行登入行为，仅针对 version 2。
# 至于自制的公钥数据就放置于用户家目录下的 .ssh/authorized_keys 内
RSAAuthentication yes
PubkeyAuthentication yes
AuthorizedKeysFile      %h/.ssh/authorized_keys

#有了证书登录了，就禁用密码登录吧，安全要紧
PasswordAuthentication no

配置好ssh服务器的配置了，那么我们就要把客户端的公钥上传到服务器端，然后把客户端的公钥添加到authorized_keys
在客户端执行命令

scp ~/.ssh/id_rsa.pub blue@<ssh_server_ip>:~
在服务端执行命令

cat  id_rsa.pub >> ～/.ssh/authorized_keys
如果有修改配置/etc/ssh/sshd_config，需要重启ssh服务器

/etc/init.d/ssh restart
 
客户端通过私钥登录ssh服务器

ssh命令

ssh -i /blue/.ssh/id_rsa blue@<ssh_server_ip>
scp命令

scp -i /blue/.ssh/id_rsa filename blue@<ssh_server_ip>:/blue
每次敲命令，都要指定私钥，是一个很繁琐的事情，所以我们可以把私钥的路径加入ssh客户端的默认配置里
修改/etc/ssh/ssh_config

#其实默认id_rsa就已经加入私钥的路径了,这里只是示例而已
IdentityFile ~/.ssh/id_rsa
#如果有其他的私钥，还要再加入其他私钥的路径
IdentityFile ~/.ssh/blue_rsa

