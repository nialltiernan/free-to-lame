#!/bin/sh
git push && ssh tiernanClub 'bash -s' < deploy/deploy.sh
