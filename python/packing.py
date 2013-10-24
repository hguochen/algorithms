##################################
### Title: Packing        ########
### Author: GuoChen Hou   ########
##################################

# Given a rectangle tray and an unlimited supply of slabs. Calculate the maximum number of slabs that can fit into the rectangular 
# tray, in a single orientation only.

def compute_max_slabs(tray_length, tray_breadth, slab_length, slab_breadth):

	length_slabs = int(tray_length / slab_length)
	breadth_slabs = int(tray_breadth / slab_breadth)
	return length_slabs * breadth_slabs

t_length, t_breadth = raw_input('Enter dimensions of tray: ').split()
s_length, s_breadth = raw_input('Enter dimensions of tray: ').split()

tray_length = int(t_length)
tray_breadth = int(t_breadth)
slab_length = int(s_length)
slab_breadth = int(s_breadth)

length_base_slab_number = compute_max_slabs(tray_length, tray_breadth, slab_length, slab_breadth)
breadth_base_slab_number = compute_max_slabs(tray_length, tray_breadth, slab_breadth, slab_length)

if length_base_slab_number > breadth_base_slab_number:
	print 'Maximum number of slabs =', length_base_slab_number
else:
	print 'Maximum number of slabs =', breadth_base_slab_number
