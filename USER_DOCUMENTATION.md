# Elective Manager

## Introduction

This project named Elective Manager, is an open source project. It will be used to allot the Elective subjects to undergradate as well as post-graduate students. These elective subjects are published by the departments and are allotted to students based on their priority of published subjects and CGPA. 

## Usage

There are mainly three interfaces:
1. Admin Login
2. Department Login
3. Student Login

* Admin Will open registration for Departmental admins (will use an authorization key for registration, it'll be a Hash). This key will be generated automatically, admin will have a separate interface to generate the key (dynamic creation of it). Admin is given the power to delete any user(student/department).

* Department Admin will post electives. When posting electives, admin will post the following details - No. of seats, Elective code (as multiple electives), Name of professor taking the course and any additional information. The option to update elective details after posting is also given to the department admin. The department admin will get the final list of the students selected for each elective.

* After login, the students are provided with the option to priortize published electives. Each student can see his/her status in each elective. students can also change or recover their passwords if forgotten.

## Contributing
Refer [CONTRIBUTING.md](https://github.com/Rishabh04-02/Elective-manager-new/blob/master/CONTRIBUTING.md)


## Installation

### Requirements

PHP, MySql, Apache

### Installation
run as php -S localhost:3000



### Configuration

You can run this project by clicking on [this link.](http://139.59.13.224:4000/)



## Found a bug?
[Submit an issue](https://github.com/Rishabh04-02/Elective-manager-new/issues) to the Elective Manager Github. And, of course, feel free to submit pull requests with bug fixes or changes.


## Maintainers
Elective Manager is built while interning at [NIT Hamirpur](http://nith.ac.in/nith/) by following Developers:

+ [Rishabh Chaudhary](https://github.com/Rishabh04-02)
- [Shubham Machal](https://github.com/shubhammachal)
* [Abhishek Kumar](https://github.com/Abhishek-sopho)


## License

For License click on the link below:

[Apache-2.0](Elective-manager-new/LICENSE.md )
