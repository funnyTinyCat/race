Intro
What's expected of you:
● Importing a CSV list of results for a race
● Calculate the average finish time & placement of runners
● Display the list accordingly
● Ability to edit a result

Entities
We will have two entities: Race and Results.
Race contains raceName and date.
Each Result has a fullName, raceTime, distance (long or medium), placement
and it is related to a Race entity.
One Race can have multiple Results.

Importing results
Create a page with a form for importing results. Form should contain race name, race
date and input field for uploading CSV results file. Here is an example of CSV file
content:

fullName,distance,time
Matthias Floyd,medium,5:15:24
1/3
Locastic d.o.o.
Lovački put 7 — HR-21000 Split, Croatia — VAT HR05555436501
+385 21 782 059 — locastic.com
Toby Phillips,long,4:07:45
Paloma Mclean,long,4:04:31
Willow Brock,medium,3:04:30
Alissa Harris,long,5:04:24
Dania Travis,long,6:04:12
Lorena Villegas,medium,2:09:31
Marc Rivera,long,6:23:14
Sergio Spears,medium,2:13:45

After a user submits the form, the submitted file should be validated and show
validation message if any of the fields are empty including the file upload field.
Process the file and save the race and results with placement to the database. Redirect
the user to the results view page.

Calculating placement
Long and medium distance have separate placements. The shorter the finish time is,
the better place it gets.

Results view page
Page should show:
- The race title and date
- Average finish time for medium distance (use database query to calculate
average)
- Average finish time for long distance (use database query to calculate average)
- Table with results for medium distance ordered by placement
- Table with results for long distance ordered by placement
- Button with link to import results form page.
- Edit button for each result

The expected response for the previous CSV file example:
Medium distance
Average: 2:25:48
Full name Finish time Placement
Lorena Villegas 2:09:31 1
Sergio Spears 2:13:45 2
Matthias Floyd 2:15:24 3
Willow Brock 3:04:30 4

Long distance
2/3
Locastic d.o.o.
Lovački put 7 — HR-21000 Split, Croatia — VAT HR05555436501
+385 21 782 059 — locastic.com
Average: 5:08:49

Full name Finish time Placement
Paloma Mclean 4:04:31 1
Toby Phillips 4:07:45 2
Alissa Harris 5:04:24 3
Dania Travis 6:04:12 4
Marc Rivera 6:23:14 5

Edit single result
Edit result page should contain form for editing single result. Full name and finish time
can be edited.
Both fields are required and should be validated. If there are validation errors, they
should be shown to the user after form submit.
After a successful edit, places should be recalculated and the user should be
redirected to the results view page.

That’s it!
If you have any questions about the task, feel free to contact us. Good luck! :)