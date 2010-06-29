#!/bin/sh

if [ -n "$1" ]
then
 echo "adding text to timestamp"
 git commit -a -m "$1 $(date)"
else
 echo "timestamping"
 git commit -a -m "$(date)"
fi
git push
