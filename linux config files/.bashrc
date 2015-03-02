#alias ls='ls -la' - more trouble than its worth

#screen tweaks
alias attach='~/savessh ; screen -D -R'
alias fixssh='source $HOME/.sshSessionStuff'
alias git='fixssh; git'
alias ssh='fixssh; ssh'

#extras
alias composer='php composer.phar'

if [ $TERM != "screen" ]; then
attach;
fi

## Print nickname for git/hg/bzr/svn version control in CWD
## Optional $1 of format string for printf, default "(%s) "
function be_get_branch {
  local dir="$PWD"
  local vcs
  local nick
  while [[ "$dir" != "/" ]]; do
    for vcs in git hg svn bzr; do
      if [[ -d "$dir/.$vcs" ]] && hash "$vcs" &>/dev/null; then
        case "$vcs" in
          git) __git_ps1 "${1:-(%s) }"; return;;
          hg) nick=$(hg branch 2>/dev/null);;
          svn) nick=$(svn info 2>/dev/null\
                | grep -e '^Repository Root:'\
                | sed -e 's#.*/##');;
          bzr)
            local conf="${dir}/.bzr/branch/branch.conf" # normal branch
            [[ -f "$conf" ]] && nick=$(grep -E '^nickname =' "$conf" | cut -d' ' -f 3)
            conf="${dir}/.bzr/branch/location" # colo/lightweight branch
            [[ -z "$nick" ]] && [[ -f "$conf" ]] && nick="$(basename "$(< $conf)")"
            [[ -z "$nick" ]] && nick="$(basename "$(readlink -f "$dir")")";;
        esac
        [[ -n "$nick" ]] && printf "${1:-(%s) }" "$nick"
        return 0
      fi
    done
    dir="$(dirname "$dir")"
  done
}


# custom bash prompt (made with http://bashrcgenerator.com/)
export GIT_PS1_SHOWDIRTYSTATE=yes
export PS1="\[\e[00;33m\]\t\[\e[0m\]\[\e[00;37m\] \[\e[00;32m\]\$(be_get_branch )\[\e[0m\]\[\e[00;36m\]\w\[\e[0m\]\[\e[00;37m\] \[\e[0m\]\[\e[00;31m\]\\$\[\e[0m\]\[\e[00;37m\] \[\e[0m\]"
#export PS1="\[\e[00;33m\]\t\[\e[0m\]\[\e[00;37m\] \u@\h \[\e[00;32m\]\$(be_get_branch )\[\e[0m\]\[\e[00;36m\]\w\[\e[0m\]\[\e[00;37m\] \[\e[0m\]\[\e[00;31m\]\\$\[\e[0m\]\[\e[00;37m\] \[\e[0m\]" - alternate design
