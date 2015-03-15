## PG 11
### Exercise 1.1

1.1.1 We are given a mechanical design in terms of library of parts, where each part may include instances of other parts,
and we need to list the parts in order so that each part appears before any part that uses it. If the design comprises n parts, there are n! possible orders, where n! denotes the factorial function.Because the factorial function grows faster than even an exponential function, we can feasibly generate each possible order and then verify that, within that order, each part appears before the parts using it. This problem is an instance of topological sorting.

We are given n points in the plane, and we wish to find the convex hull of these points. The convex hull s the smallest convex polygon containing the points. Intuitively, we can think of each point as being represented by a tight rubber band that surrounds all the nails. Each nail around which the rubber band makes a turn is a vertex of the convex hull.

1.1.2 Measure of efficiency can also be in terms of the space requirement. ie. the amount of memory a program requires in order to execute its task.

1.1.3 A queue is based on the FIFO principle. That is, new items are added to the back of the queue and oldest items are processed first. This data structure is good for tracking events which happen in choronological order. But is bad if you require a search for any items in the structure. It also doesn't support random access to elements.

1.1.4 Both shortest path and travelling salesman problem are are algorithm process of solving a given problem. Travelling salesman
problem is NP-complete which does not have a known efficient algorithm whereas shortest path has a known efficient algorithm.

1.1.5 Systematic sorting of products in ecommerce solutions such as amazon. The best solution will usually be financially sound and are most cost efficient. Sorting with accordance to date of delivery or a given priority number could be a useful system to this problem.