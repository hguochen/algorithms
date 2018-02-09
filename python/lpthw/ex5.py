my_name = "Test"
my_age = 32
my_height = 74  # inches
my_weight = 140  # lbs
my_eyes = 'black'
my_teeth = 'white'
my_hair = 'brown'

print "Let's talk about %s." % my_name
print "He's %d inches tall." % my_height
print "He's %d pounts heavy" % my_weight
print "Actually not too heavy."
print "He's got %s eyes and %s hair." % (my_eyes, my_hair)
print "His teeth are usually %s depending on the coffee." % my_teeth

print "If I add %d, %d, and %d I get %d." % (
    my_age, my_height, my_weight, my_age + my_height + my_weight)

print "this is %r " % my_age

# d   Signed integer decimal.
# i   Signed integer decimal.
# o   Unsigned octal. (1)
# u   Unsigned decimal.
# x   Unsigned hexadecimal (lowercase).   (2)
# X   Unsigned hexadecimal (uppercase).   (2)
# e   Floating point exponential format (lowercase).
# E   Floating point exponential format (uppercase).
# f   Floating point decimal format.
# F   Floating point decimal format.
# g   Same as "e" if exponent is greater than -4 or less than precision,
# "f" otherwise.
# G   Same as "E" if exponent is greater than -4 or less than precision,
# "F" otherwise.
# c   Single character (accepts integer or single character string).
# r   String (converts any python object using repr()).   (3)
# s   String (converts any python object using str()).    (4)
# %   No argument is converted, results in a "%" character in the result.

print "r converts any python object using repr(): %r" % 'a_string'
print "s converts any python object using str(): %s" % 'a_string_s'
print "prints nothing but a %"
print "%c" % 's'
print "%c" % 'a'
print "%c" % '"'
print "%c" % 97
print "%d" % 435
print "%i" % -435
print "%o" % 435
print "%u" % 435
print "%x" % 435
print "%X" % 435
print "%.2e" % 435
print "%.3e" % 435
