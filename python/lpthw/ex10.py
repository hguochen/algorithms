tabby_cat = "\tI'm tabbed in."
persian_cat = "I'm split\non a line."
backslash_cat = "I'm \\ a \\ cat."

fat_cat = """
I'll do a list:
\t* Cat food
\t* Fishies
\t* Catnip\n\t* Grass\a
"""

print tabby_cat
print persian_cat
print backslash_cat
print fat_cat

# List of all escape sequences
# \\ backslash
# \' single quote
# \" double quote
# \a ASCII bell
# \b ASCII backspace
# \f ASCII formfeed
# \n ASCII linefeed
# \N{name} character named name in the unicode database
# \r ASCII carriage return
# \t ASCII horizontal tab
# \uxxxx character with 16 bit hex value xxxx
# \Uxxxxxxx character with 32 bit hex value xxxxxxx
# \v ASCII vertical tab
# \ooo Character with octal value oo
# \xhh character with hex value hh

while True:
    for i in ["/", "-", "|", "\\", "|"]:
        print "%s\r" % i,
