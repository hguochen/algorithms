"""
This file contains a list of method references for a dictionary
"""

# initialize a dictionary
stuff = {
    'name': 'Zed',
    'age': 35,
    'height': 4 * 12
}

# you can also build a dictionary directly from sequence of key value pairs
new_stuff = dict([('sape', 4139), ('guido', 4217), ('jack', 4098)])

# you can also create dictionaries with dict comprehension
new_stuff_2 = {x: x**2 for x in [2, 4, 6]} # {2: 4, 4: 16, 6: 36}

# access an item in dictionary by key
print stuff['name']

# delete a key value pair from dictionary
del stuff['height']
print stuff

# get a list of keys in the dictionary
print stuff.keys()

# check if a key is in dictionary
print 'name' in stuff
print 'height' in stuff


# loop over a dictionary
knights = {'gallahad': 'the pure', 'robin': 'the brave'}
for k, v in knights.iteritems():
    print k, v
