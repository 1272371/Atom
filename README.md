![Cover photo of project] (/img/cover/github-cover-photo.png)

## Integrate project with Git and Xampp
* Navigate to the *htdocs* in your Xampp installation folder
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