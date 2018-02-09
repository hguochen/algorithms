from sys import argv

script, filename = argv

# open a filename and assign the result to txt
txt = open(filename)

print "Here's your file %r:" % filename
# read the contents of txt, which has results of opening the file
print txt.read()
txt.close()

print "Type the filename again:"
file_again = raw_input("> ")

txt_again = open(file_again)

print txt_again.read()
txt_again.close()
