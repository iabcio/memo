vim整理
alias vi='vim'
1)文件的打开与关闭
vi filename : 打开或新建文件，并将光标置于第一行行首
vi +n filename : 打开文件，并将光标置于第n行行首
vi + filename : 打开文件，并将光标置于最后一行行首
vi +/pattern filename: 打开文件，并将光标置于第一个与pattern匹配的串处
vi -r filename : 在上次正用vi编辑时发生系统崩溃，恢复filename
vi filename...filename :打开多个文件，依次进行编辑
:e filename : 打开filename编辑，编辑完后可用:hide退回 之前编辑的文件
:sav filename : 将当前文件另存为filename
:w : 保存文件但不退出vi
:w file : 将文件另存为file但不退出vi
:wq或ZZ或:x : 保存文件并退出vi
:q! : 不保存文件，退出vi
:e : 放弃所有修改，从上次保存文件开始再编辑(重新载入文件,包含被其它编辑器修改过的)
:e! : 放弃所有修改，从上次保存文件开始再编辑
:hide : 隐藏当前编辑的文件,回到上一次编辑的文件(在打开多文件时有效)
:b 2 : 在当前窗口切换到第二个打开的文件
^w^w : 多窗口切换
2)光标控制与屏幕调整
h或^h : 将光标向左移一个字符
j或^j或^n : 将光标向下移一行
k或^p : 将光标向上移一行
l或空格 : 将光标向右移一个字符
0或| : 将光标移到当前行的第一列
n| : 将光标移到当前行的第n列
^ : 将光标移到当前行的第一个非空字符
$ : 将光标移到当前行的最后一个字符
n$ : 将光标移到当前行下第n-1行的最后一个字符
+或return : 将光标移到下一行的第一个字符
- : 将光标移到前一行的第一个非空字符
gg : 将光标移动到文件第一行
G : 将光标移到文件的最后一行
nG或ngg或:n : 将光标移到文件的第n行
w : 将光标移到下一个字的开头
W : 将光标移到下一个字的开头，忽略标点符号
b : 将光标移到前一个字的开头
B : 将光标移到前一个字的开头，忽略标点符号
e : 将光标移到下一个字的结尾
E : 将光标移到下一个字的结尾，忽略标点符号
L : 将光标移到屏幕的最后一行
M : 将光标移到屏幕的中间一行
H : 将光标移到屏幕的第一行
nH : 将光标移动到屏幕顶行下的第n行
M : 将光标移动到屏幕的中间
L : 将光标移动到屏幕的底行
nL : 将光标移动到屏幕底行上的第n行
( : 将光标移动到句子的开头
) : 将光标移动到句子的结尾
{ : 将光标移动到段落的开头
} : 将光标移动到段落的结尾
[[ : 将光标移动到函数(段落)开始处
]] : 将光标移动到函数(段落)结尾处
[{ : 将光标移动到块开始处
}] : 将光标移动到块结束处
m(a-z) : 用一个字母来标记当前位置，如用mz表示标记z
'(a-z) : 将光标移动到指定的标记，如用'z表示移动到标记z处
'' : 两个单引号,将光标移动到最近标记的位置
`` : 两个反引号(Tab键上面那个),将光标移动到光标前一次停留的位置
^e : 将屏幕上滚一行
^y : 将屏幕下滚一行
^u : 将屏幕上滚半页
^d : 将屏幕下滚半页
^b : 将屏幕上滚一页
^f : 将屏幕下滚一页
^l : 重绘屏幕
z-return : 将当前行置为屏幕的顶行
nz-return : 将当前行下的第n行置为屏幕的顶行
z. : 将当前行置为屏幕的中央
nz. : 将当前行上的第n行置为屏幕的中央
z- : 将当前行置为屏幕的底行
nz- : 将当前行上的第n行置为屏幕的底行
3)插入文本
a : 在光标后插入文本
A : 在当前行尾插入文本
i : 在光标前插入文本
I : 在当前行前插入文本
o : 在当前行的下边插入新行
O : 在当前行的上边插入新行
escape(Esc) : 回到命令模式
^v : 切换到visual block模式,此时通过方向键选中block, 再按I,然后输入需要
插入的字符,可以在选中块行首插入字符(同理可以将I换为X删除字符).
4)修改文本
rchar : 用char替换当前字符(r,即replace当前光标选中字符)
Rtext escape : 用text替换当前字符直到换下Esc键(R,即进入Replace模式)
stext escape : 用text代替当前字符(s,即删除当前光标选中字符,并进入插入状态)
S或cctext escape : 用text代替整行(S,即删除当前光标选中行,并进入插入状态)
cwtext escape : 将当前字改为text(cw,即删除当前光标后一个字,并进入插入状态)
Ctext escape : 将当前行余下的改为text(C,即删除当前光标后字符直到行尾,并进入插入状态)
cG escape : 修改至文件的末尾(cG,即删除当前光标后字符直到文件结束,并进入插入状态)
ncw或cnw : 修改指定数目的字 (cnw,即删除当前光标后n个字符,并进入插入状态)
nC : 修改指定数目的行 (nC,即删除当前光标后字符直到行尾,并删除之后的n-1行,并进入插入状态)
ccursor_cmd text escape : 从当前位置处到光标命令位置处都改为text,如假设光标停留在u第10行,c5G text escape,
即删除第5行到第10行,并进入插入状态,输入text,直到escape
底行命令
:n1,n2 co n3 : 将n1行到n2行之间的内容拷贝到第n3行下
:n1,n2 m n3 : 将n1行到n2行之间的内容移至到第n3行下
:n1,n2 d : 将n1行到n2行之间的内容删除
:!command : 执行shell命令command
:n1,n2 w!command : 将文件中n1行至n2行的内容作为command的输入并执行command
:w!command : 将文件中的内容作为command的输入并执行之
:r!command : 将命令command的输出结果放到当前行
:1,10 w outfile : 保存文件第1行到第10行到outfile
:1,10 w >> outfile : 将文件第1行到第10行追加到outfile文件结尾
:r infile : 读取infile到当前光标下一行
:nr infile : 读取infile到当前光标第n行的下一行
J : 将下一行连接到当前行的末尾
nJ : 连接后面n行
5)删除文本
x : 删除光标处的字符，可以在x前加上需要删除的字符数目
nx : 从当前光标处往后删除n个字符
X : 删除光标前的字符，可以在X前加上需要删除的字符数目
nX : 从当前光标处往前删除n个字符
dw : 删至下一个字的开头
ndw : 从当前光标处往后删除n个字
dG : 删除字符直到文件结束
dd : 删除当前行
ndd : 从当前行开始往后删除n行
db : 删除光标前面的字
ndb : 从当前行开始往前删除n字
:n,md : 从第n行开始删除到第m行
d$ : 从光标处删除到行尾
dcursor_command : 删除至光标命令处，如dG将从当产胆行删除至文件的末尾
dh : 删除光标前一个字符
dl : 删除光标选中的那个字符
dj : 删除光标选中行及下一行
dk : 删除光标选中行及上一行
dH : 从屏幕顶端删除至光标处
dM : 删除屏幕中央行于光标之间的内容
dL : 从光标处删除至屏幕末尾
dk : 删除光标选中行及上一行
dH : 从屏幕顶端删除至光标处
^h或backspace : 删除前面的字符(插入状态下)
^w : 删除前面的字(插入状态下)
6)查找与替换
:set ic : 查找时忽略大小写(ignorecase)
:set noic : 查找时对大小写敏感
/text : 在文件中向前查找text
?text : 在文件中向后查找text
* : 在文件中向前查找当前光标选中的字
n : 在同一方向重复查找
N : 在相反方向重复查找
fchar : 在当前行向前查找char
Fchar : 在当前行向后查找char
tchar : 在当前行向前查找char，并将光标定位在text的第一个字符
Tchar : 在当前行向后查找char，并将光标定位在text的第一个字符
/\cstring : 查找STRING或string,大小写不敏感
/jo[ha]n : 查找john或joan
/\< the : 查找the,theatre或then等the开头的单词
/the\> : 查找the或breathe等the结尾的单词
/\< the\> : 查找 the(空格后紧跟the)
/fred\|joe : 查找fred或joe
/\<\d\d\d\d\> : 查找4个字符的单词
/^\n\{3} : 查找连续3个空行
:bufdo /searchstr/ : 在所有打开文件中查找
bufdo %s/some/someelse/g : 在所有打开文件中查找some并用someelse代替
& 重复最后的:s命令
:g/text/command : 在所有包含text的行运行command所表示的命令
:v/text/command : 在所有不包含text的行运行command所表示的命令
:g/string/d : 删除所有包含string的行
:v/string/d : 删除所有不包含string的行
:g/text1/s/text2/text3 : 查找包含text1的行，用text3替换text2
:v/text1/s/text2/text3 : 查找不包含text1的行，用text3替换text2
:%s/old/new/g : 将文件中所有old替换为new(大小写敏感)
:%s/onward/forward/gi : 将文件中所有onward替换为forward(忽略大小写)
:%s/old/new/gc : 将文件中所有old替换为new,替换前需确认
:%s/^/hello/g : 将文件中所有开头替换为hello
:%s/$/Harry/g : 将文件中所有结尾替换为Harry
:%s/ *$//g : 删除所有空格
:%s/Bill/Steve/g : 将当前文件的所有Bill替换为Steve
:%s/^M//g : 删除所有Dos回车符 (^M)
:%s/^M/\r/g : 删除所有Dos回车符转化成标准回车符
:%s#<[^>]\+>##g : 删除所有HTML标记只留下内容
:%s/^\(.*\)\n\1$/\1/ : 删除重复行
:s/Bill/Steve/ : 将当前行第一个Bill替换为Steve
:s/Bill/Steve/g : 将当前行所有Bill替换为Steve
:m,n s/Bill/Steve/ : 在m行和n行之间,将第一个Bill替换为Steve
:m,n s/Bill/Steve/g : 在m行和n行之间,将所有Bill替换为Steve
:2,35s/old/new/g : 将第2行到第35行之间所有old替换为new
:5,$s/old/new/g : 将第5行到文件结尾之间所有old替换为new
^a : 将光标选中的数字加1
^x : 将光标选中的数字减1
ggVGg? : 将全文替换为回转13位文,变换2次可以回到原文.
7)复制文本
yw : 将光标后一个字放入临时缓冲区
nyw或ynw : 将光标后n个字放入临时缓冲区
y : 将当前行及下一行的内容放入临时缓冲区(命令模式下)
y : 将当前光标选中的内容放入临时缓冲区(选择模式下)
yy : 将当前行的内容放入临时缓冲区
y$ : 将当前行光标之后的内容放入临时缓冲区
D : 将当前行光标之后的内容剪切后放入临时缓冲区
nyy : 将n行的内容放入临时缓冲区
p : 将临时缓冲区中的文本放入光标后
P : 将临时缓冲区中的文本放入光标前
gh : 进入选择模式,通过光标选择内容,选择完毕后按y将选择内容删除并放入缓冲区,并插入y,进入插入模式
gH : 进入选择模式,通过光标选择内容,选择完毕后按y将选择内容所在行删除并放入缓冲区,并插入y,进入插入模式
gv : 进入选择模式,通过光标选择内容,选择完毕后按y将选择内容并放入缓冲区,不删除选择内容
寄存器操作
"(a-z)nyy : 复制n行放入名字为圆括号内的可命名缓冲区，省略n表示当前行
"(a-z)ndd : 删除n行放入名字为圆括号内的可命名缓冲区，省略n表示当前行
"(a-z)p : 将名字为圆括号的可命名缓冲区的内容放入当前行后
"(a-z)P : 将名字为圆括号的可命名缓冲区的内容放入当前行前
8)撤消与重复
u : 撤消最后一次修改
U : 撤消当前行的所有修改
^r : 重新执行最近一次被撤消的操作
. : 重复最后一次操作
5. : 重复最后一次操作5次
, : 以相反的方向重复前面的f、F、t或T查找命令
; : 重复前面的f、F、t或T查找命令
"np : 取回最后第n次的删除(缓冲区中存有一定次数的删除内容，一般为9)
n : 重复前面的/或?查找命令
N : 以相反方向重复前面的/或?命令
9)vim中的选项
:set all : 打印所有选项
:set nooption : 关闭option选项
:set nu : 每行前打印行号
:set nonu : 每行前不打印行号
:set showmode : 显示是输入模式还是替换模式
:set ic : 查找时忽略大小写(另一种设置见下文)
:set noic : 查找时不忽略大小写
:set list : 显示制表符(^I)和行尾符号
:set ts=4 : 为文本输入设置tab stops
:set ws=4 : 为文本输入缩进设置4字符
:set window=n : 设置文本窗口显示n行
:syntax on : 打开语法高亮
:syntax off : 关闭语法高亮
:set syntax=erlang : 强制语法高亮,并按erlang语法显示高亮
10)vim的状态
:.= 打印当前行的行号
:= 打印文件中的行数
^g 显示文件名、当前的行号、文件的总行数和文件位置的百分比
:l 使用字母"l"来显示许多的特殊字符，如制表符和换行符
11)shell转义命令
:!command : 执行shell的command命令，如:!ls
:!! : 执行前一个shell命令
:r!command : 读取command命令的输入并插入，如:r!ls会先执行ls，然后读入内容
:w!command : 将当前已编辑文件作为command命令的标准输入并执行command命令，如:w!grep all
:cd directory : 将当前工作目录更改为directory所表示的目录
:pwd : 显示当前工作目录
:so file : 在shell程序file中读入和执行命令
:!pwd : 执行pwd命令,然后回到vi
!!pwd : 执行pwd命令,然后插入其输出结果到当前文件,并替换光标所在行
:sh : 将启动一个子shell，使用^d(ctrl+d)返回vi
^d或$exit : 退出临时开启的终端并回到vi
12)宏与缩写
(PS:避免使用控制键和符号，不要使用字符K、V、g、q、v、*、=和功能键)
:map key command_seq : 定义一个键来运行command_seq，如:map e ea，无论什么时候都可以e移到一个字的末尾来追加文本
:map : 在状态行显示所有已定义的宏
:umap key : 删除该键的宏
:ab string1 string2 : 定义一个缩写，使得当插入string1时，用string2替换string1。当要插入文本时，键入string1然后按Esc键，系统就插入了string2
:ab mail mail@126.com :定义mail作为mail@126.com的缩写
:ab : 显示所有缩写
:una string : 取消string的缩写
13)排版与缩进
:set ai : 打开自动缩进
:set autoindent : 打开自动缩进
:set smartindent : 打开智能缩进
:set sw=n : 将移动宽度(缩进的大小)设置为n个字符
:set shiftwidth=4 : 将移动宽度(缩进的大小)设置为4个字符
^i(ctrl+i)或tab : 插入文本时，插入移动的宽度，移动宽度是事先定义好的
^t : 缩进一次(插入模式下)
^d : 取消缩进一次(插入模式下)
>> : 缩进一次
<< : 取消缩进一次
n<< : 使光标选中行开始后的n行都向左移动一个宽度
n>> : 使光标选中行开始后的n行都向右移动一个宽度，例如3>>就将接下来的三行每行都向右移动一个移动宽度
nggm>> : 将第n行开始的m行整体右移一个缩进
nggm<< : 将第n行开始的m行整体左移一个缩进
:n,m >>> : 将第n行到第m行整体右移3个缩进,一个缩进是>
:n,m << : 将第n行到第m行整体左移2个缩进,一个缩进是<
Vu : 将当前行全部字母改成小写
VU : 将当前行全部字母改成大写
~ : 反转光标选中字母的大小写
g~~ : 反转当前行全部字母的大小写
vEU : 将当前选中单词改成大写
vE~ : 反转光标选中单词的大小写
ggguG : 将当前文件全部字母改成小写
gggUG : 将当前文件全部字母改成大写
:set ignorecase : 搜索时忽略大小写
:set smartcase : 搜索时智能忽略,忽略一个大写字母(如忽略首字母大写)
:%s/\<./\u&/g : 设置文件中每个单词首字母大写
:%s/\<./\l&/g : 设置文件中每个单词首字母小写
:%s/.*/\u& : 设置当前行中每个单词首字母大写
:%s/.*/\l& : 设置当前行中每个单词首字母小写
=% : 将括号内的代码缩进
1GVG= : 将整个文件缩进
gg=G:代码缩进排版(全局通过indent缩进)
20G=30G:20~30行之间的代码通过indent缩进
Align:
:%!fmt : 所有行对齐
!}fmt : Align all lines at the current position
5!!fmt : Align the next 5 lines
Tabs/Windows(功能不熟悉,待研究):
:tabnew : Creates a new tab
gt : Show next tab
:tabfirst : Show first tab
:tablast : Show last tab
:tabm n(position) : Rearrange tabs
:tabdo %s/foo/bar/g : Execute a command in all tabs
:tab ball : Puts all open files in tabs
:new abc.txt : Edit abc.txt in new window
14)vim中的文件浏览器
:e . : 在整合的窗口中打开文件浏览器,显示当前目录,另一个是之前vim编辑窗口
:Sex : 上下分屏,打开一个文件浏览器,另一个是之前vim编辑窗口
:Sex! : 左右分屏,打开一个文件浏览器,另一个是之前vim编辑窗口
:browse e : 打开图形界面的文件浏览器(貌似操作失败,待研究)
:ls : 显示当前缓冲区保存的内容
:cd .. : 切换到上一级目录
:args : 显示文件列表
:args *.php : 显示包含.php文件列表(待研究)
:grep expression *.php : 返回一个和expression匹配的包含.php的文件列表
gf : 打开和光标选中的同文件的文件(在文件浏览器中有效)
分屏显示:
:e filename : 在当前窗口编辑filename
:split filename : 上下分屏,并打开filename
^w <Up> : 将光标移到上一个窗口
^w^w : 将光标移到下一个窗口
^w_ : 纵向扩大当前窗口
^w| : 横向扩大当前窗口
^w= : 设置所有窗口相同大小(效果不明显,估计是面积大小相同)
10 ^w+ : 增加10行到当前窗口
:vsplit file : 左右分屏,并打开file
:sview file : 上下分屏,并以只读方式打开file
:hide : 关闭当前窗口
:nly : 关闭所有其它窗口
:b 2 : 在当前窗口打开第二个文件,#2
自动完成:
^x^n或^n : 补全单词(插入模式下)
^p : 取消补全单词(插入模式下)
^x^l : 补全行(插入模式下)
:set dictionary=dict : 设置dict为补全字典,dict为自定义字典路径,可google如何设置
^x^k : 根据字典补全,字典未设置会提示
^x^d : 头文件不全,也需要设置

去除重复行
: sort   //可以直接排序，这个太好用了
:g/^\(.*\)$\n\1$/d                      //去除重复行
:g/\%(^\1$\n\)\@<=\(.*\)$/d     //功能同上，也是去除重复行
:g/\%(^\1\>.*$\n\)\@<=\(\k\+\).*$/d  //功能同上，也是去除重复行 


sed -n 'G;s/\n/&&/;/^\([ -~]*\n\).*\n\1/d;s/\n//;h;P'


附件:
sudo vi + /etc/vimrc
set wildmenu
set mouse=a
set mouse=v
set selection=exclusive
set selectmode=mouse,key
set cmdheight=2
set fillchars=vert:\ ,stl:\ ,stlnc:\
set matchtime=5
set formatoptions=tcrqn
set autoindent
set smartindent
set cindent
set tabstop=4
set softtabstop=4
set shiftwidth=4
set noexpandtab
set nowrap
set smarttab
set nu!
set foldenable
set foldmethod=manual
nnoremap <space> @=((foldclosed(line('.')) < 0) ? 'zc':'zo')<CR>
set cursorline " hightlight cursor line
set backspace=indent,eol,start
set incsearch
syntax enable
"source $VIMRUNTIME/syntax/php.vim
"source $VIMRUNTIME/syntax/c.vim
source $VIMRUNTIME/syntax/python.vim

set fileencodings=utf-8,ucs-bom,gb18030,gbk,gb2312,cp936
set termencoding=utf-8
set encoding=utf-8
 

