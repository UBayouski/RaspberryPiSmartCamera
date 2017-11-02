#!/bin/bash

rclone -v move $1* remote:oculus --delete-after --include *.mp4 --include *.jpg