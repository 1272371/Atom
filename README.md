![Cover photo of project](/img/cover/github-cover-photo.png)

## Integrate project with Git and Xampp
* Navigate to the **htdocs** in your Xampp installation folder
* If you haven't configured GitHub globally yet use
```
git config --global user.name "John Doe"
git config --global user.email "johndoe@example.com"
```
* After configurating your GitHub in the *htdocs* folder run the following commands
```
git pull origin master --allow-unrelated-histories
```
* Use the `git push -u origin master` command as `git push` will return the following error
```
fatal: The current branch master has no upstream branch
To push the current branch and set the remote as upstream, use
git push --set-upstream origin master
```

## Including Bootstrap in HTML files
Bootstrap has several files that you need to attatch in your `HTML` documents
* JavaScript files
```html
<body>
    <!--Attach this just before the closing body tag-->
    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    <script src="js/popper.min.js"></script>
</body>
```
* CSS files
```html
<head>
    <!--Attach this anywhere in the head tags-->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
```
## Restful API integration
This Api will be used for testing and realtime data requests and to allow the front end to fetch data
from the database without reloading(also with the aid of AJAX) the page.
Create a database called api_risk using phpmyadmin then import the risk.sql database inside this new
database,this database is inside the api folder
so far the api only accepts two urls namely the the `http://localhost/api/register` and the `http://localhost/api/login` urls and then 
the json data that is associated with them  e.g the register api request is accompanied by {username:data, password:data, confirm:data, type:data, name:data, surname:data, faculty:data,school:data,enroll_year:data} json data
where data represents the different strings for that specific variable,
And the login api request is accompanied by the {username:data,password:data} json data.
We can then get a response from the api based on the url and the json data that we have provided
i.e if we provide a username/student nr that does not exist in the login url i.e in http://localhost/api/login and {username:"1234567":password:"caihfwai"} from the api we'll get a 'user does not exist' json status
or if the password is incorrect we'll get a 'incorrect password' json response from the api.

These responses can be interpreted by any language that can handle json(almost all languages),and as a result we can edit data,store,analyze data,use unit testing without breaking/modifying any past code.   
In order to see these request and responses one can install a software called POSTMAN,it is specifically made for api integrations(and it makes is easy for you to send these requests using most common programming language i.e java,python,php,javascript,...etc).

## Branch Management
In your github fork, you need to keep your master branch clean, by clean I mean without any changes, like that you can create at any time a branch from your master. Each time that you want to commit a bug or a feature, you need to create a branch for it, which will be a copy of your master branch.

When you do a pull request on a branch, you can continue to work on another branch and make another pull request on this other branch.

Before creating a new branch, pull the changes from upstream. Your master needs to be up to date.

Create the branch on your local machine and switch in this branch :
$ git checkout -b [name_of_your_new_branch]

Change working branch :
$ git checkout [name_of_your_new_branch]

Push the branch on github :
$ git push origin [name_of_your_new_branch]

When you want to commit something in your branch, be sure to be in your branch. Add -u parameter to set upstream.

You can see all branches created by using :
$ git branch

Which will show :

* approval_messages
  master
  master_clean

Add a new remote for your branch :
$ git remote add [name_of_your_remote] 

Push changes from your commit into your branch :
$ git push [name_of_your_new_remote] [name_of_your_branch]

Update your branch when the original branch from official repository has been updated :
$ git fetch [name_of_your_remote]

Then you need to apply to merge changes, if your branch is derivated from develop you need to do :
$ git merge [name_of_your_remote]/develop

Delete a branch on your local filesystem :
$ git branch -d [name_of_your_new_branch]

To force the deletion of local branch on your filesystem :
$ git branch -D [name_of_your_new_branch]

If you want to change default branch, it's so easy with github, in your fork go into Admin and in the drop-down list default branch choose what you want.


