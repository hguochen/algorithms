## PG 74
### Exercise 4.1

4.1.1 
Returns the largest negative number and its low, high range.

4.1.2
results = []
for i in range(len(list)):
    sum = list[i]
    for j in range(i+1, len(list)):
        sum += list[j]
        results.append([i, j, sum])
answer = result[0]
largest = result[0][2]
for item in results:
    if item[2] > largest:
        largest = item[2]
        answer = item
return answer