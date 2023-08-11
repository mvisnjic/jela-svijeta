#!/bin/bash

BASE_URL="http://localhost:8000/api/meals";

RANDOM_NUM_REQUESTS=$((RANDOM % 21 + 30))

for ((i=0; i<$RANDOM_NUM_REQUESTS; i++)); do
	MEAL_ID=$((RANDOM % 100 + 1))
	curl --request "DELETE" http://localhost:8000/api/meals/delete/$MEAL_ID
	echo "deleted:$MEAL_ID"

done
