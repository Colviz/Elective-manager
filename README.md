## Elective Manager New
> This is the Elective Manager which will be used for Elective allotments (Open electives as well as Departmental electives). <br>
> Develop it keeping in mind its **Flexibility**, **Stability** and **Security**.

run as `php -S localhost:3000`

## Project Completed - **13/55 - 23%**
Calculated from Features to Implement completion percentage.

## Languages and Packages used -
> PHP, Javascript, MySql, Google Material Design, PHP-API (self created)

## Features to Implement

### **General**
- [ ] Add captcha on every form.
- [ ] Should work for both Open elective as well as Departmental elective allotments.
- [ ] Should have a secure password recovery mechanism for all the interfaces.
- [x] 3 login interfaces - **Admin**, **Student** and **Department**.
- [x] Do routing.
- [x] Use OOP and functions to get the work done.
- [x] Use Javascript for field validations.
- [ ] Use Ajax for real time loading.
- [x] Responsive Design.
- [ ] Open source this project and provide long term support.
- [x] Prevent attacks eg. Sql Injections (Use PDO, prepare queries, mysqli_real_escape_string(), stripslashes()).
- [x] Avoid code redundancy.
- [x] All design etc. files common for all interfaces should be put together, reduces redundancy.
- [x] Use google API for sending all kinds of mails - used mailgun (opensource).
- [ ] Make a report bugs page, it's link should be on the footer, while reporting a bug if the session is set then also send the name of session user in the report.
- [ ] Make an interactive 404 error page, can also display the names of developers on the page.
- [x] Footer should have a credits link also.
- [ ] Add page hits counter
- [	] All the open forms (can be accessed without login, eg. bugs) should have a captcha.
- [ ] Store logs for every activity.

### **Admin Interface**
- [ ] Gets the final list of students selected for each elective.
- [ ] Gets the notification when department deletes an elective/closes registration.
- [ ] Admin will get a mail if any of the above things happen.
- [ ] Can see all the available departments.
- [ ] Can see all the departments with no. of published electives.
- [ ] Can delete/unpublish/close registration for any elective.
- [x] Will open registration for Departmental admins (will use an authorization key for registration, it'll be a Hash). This key will be generated automatically, admin will have a separate interface to generate the key (dynamic creation of it).
- [x] If the tokens are already generated then admin can view both the tokens.
- [ ] if (total no. of seats for electives < no. ofstudents registered) { then admin will get a notification regarding this along with Super admin. } <sup>problem</sup> there is a problem in it, how can we handle this for all different type of electives(UG 3rd year & PG final year, branch wise).
- [ ] Remove the temporary display of email contents and uncoment the mail() function.
- [x] If session already set, then login directly on register and login pages.
- [x] Redirect to login page after successful registration.
- [ ] Admin can delete any user (Student/Department)
- [ ] Add request handlers for fake students registrations/resetting of account (can use registration no. of JEE Mains, feedback verification password).

### **Department Interface**
- [x] 2 Admins (Super Admin (H.O.D.) and Elective poster (Professor)).
- [ ] Super Admin gets the final list of students selected for each elective.
- [ ] Elective poster have the ability to post multiple electives.
- [ ] Elective posting confirmation will go to Admin once approved by Super Admin.
- [ ] Elective when approved by Super Admin and published, will be open for registrations.
- [ ] if (total no. of seats for electives < no. ofstudents registered) { then admin will get a notification regarding this along with Super admin. } <sup>problem</sup> there is a problem in it, how can we handle this for all different type of electives(UG 3rd year & PG final year, branch wise).
- [x] Add UG/PG Elective, subject codes will be chosen from dropdown.
- [ ] Add option for no. of seats available for the elective.
- [ ] if (no. of registered students for the elective <= no. of seats available) { Students status will remain automatically **Confirmed** }<br>
else if ( no. of students > no. of seats available) { then no. of students till no. of seats (sorted by CGPA and priority) will have their status as **Confirmed** by default and others status will be **Waiting** }
- [ ] if (the elective poster rejects any student with the status as **Confirmed** by default) { then he/she needs to give a strong and valid reason for rejection with reason of min. characters 10.<br>Student gets its notification by mail and on the interface. }
- [ ] Add auto close registration when the no. of students == no. of seats available, will opt for this option on the time of publishing of elective.
- [ ] Can view the list of students selected and the students who've applied for the elective.
- [ ] When posting elective will post the following details - No. of seats, Elective code (as multiple electives), Name of professor taking the course, Any additional information, Auto close registration/not.
- [ ] Have the option to update elective details after posting (Keep in mind about auto close registration case).
- [ ] Timestamp will be added on every registration request,rejection, publishing elective, super admin confirmation, updating, etc.
- [x] Department name, elective names, etc. will be available from CC.

### **Student Interface**
- [ ] Mail sending on successful allotment of seat, rejection.
- [ ] Login will be with the help of roll no.
- [ ] After logging in student will prioritize electives (Priority once set can't be updated - show prompt).
- [ ] Show students all info available for the elective including the no. of vacant seats, also the last CGPI selected and applied (update dynamically).
- [ ] After the student applies show his/her status in each elective (update dynamically).
- [ ] Timestamp while setting priorities will also be set.
- [ ] Allow students to change and recover passwords.
