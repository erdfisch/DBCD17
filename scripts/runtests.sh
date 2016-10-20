#!/bin/sh

CI_PROJECT_NAME=$1
CI_BUILD_ID=$2
BEHAT_OUT_PATH=build/reports

TEST_RESULT=0
count=0

mkdir -p $BEHAT_OUT_PATH

features=$(find test/behat/features/ci -name '*.feature' | sort)

for feature in $features
do
  printf "\n$feature\n"

  count=$((count+1))
  f_count=$(printf "%02d" $count)
  filename=$(basename "$feature")
  filename="${filename%.*}"
  filename="${f_count}_${filename}"
  bin/behat -c test/behat/behat.yml --tags api -f 'progress' --out=std -f 'pretty' --out=$BEHAT_OUT_PATH/report_$filename.log -f 'html' --out=$BEHAT_OUT_PATH/report_$filename.html $feature
  # bin/behat --config=test/behat/behat.yml --tags api --format=progress $feature

  LAST_TEST_RESULT=$?
  if [ $TEST_RESULT = 0 ]
    then TEST_RESULT=$LAST_TEST_RESULT
  fi

done

exit $TEST_RESULT


