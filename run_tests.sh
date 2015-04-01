#! /usr/bin/env bash

for x in app/tests/R4-Tests/*
do
	phpunit "$x/"
done
