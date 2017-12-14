#!/bin/bash
source="$(dirname $1)"
file="$(basename $1)*"

rclone -v move $source remote:oculus --include $file &
