 1) fedora , mint
sudo vi /etc/vimrc
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
 
2) ubuntu
sudo vi ~/vimrc
 
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
 
 
 

