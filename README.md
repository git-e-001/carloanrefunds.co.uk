<p align="center">
carloanrefunds.co.uk
</p>

## Framework used

- Laravel v8.X
- Bootstrap v4.5.6

## Server Requirements

- PHP >= ^7.3|^8.0,
- PHP Extension BCMath
- PHP Extension ctype
- PHP Extension OpenSSL
- PHP Extension PDO
- PHP Extension Tokenizer
- PHP Extension dom
- PHP Extension fileinfo
- PHP Extension ftp
- PHP Extension gd
- PHP Extension intl
- PHP Extension json
- PHP Extension libxml
- PHP Extension mbstring
- PHP Extension soap
- PHP Extension xml
- PHP Extension xsl
- PHP Extension zip
- PHP Extension zlib

#### Step:1 Project setup
- You need to clone the git at very first. to clone git use this command `git clone https://github.com/hudacse6/carloanrefunds.co.uk.git` (this is https link)
- After that you need copy and paste **.env.example** and setup your **.env** file.
- Then you need to **install Composer**. You can download it from this [link](https://getcomposer.org/download/)
- Then you need to run these commands.
```
php artisan key:generate
php artisan migrate
php artisan db:seed (if seeder available)
php artisan serve
```


#### Step:2 Getting name from Trello card.
- You will get access to the Trello board and you will found all the working, In progress tasks there. Mainly you need to take the card name for your branch name.
#### Step:3 Convert Trello name into Branch name
- You need to convert/Generate the Trello name into a branch name. 
- For generating branch name you can use this [link](https://devtools.stackblitz.io/)
- Here is the image as an example where you need to put what. 
![0](https://user-images.githubusercontent.com/78661753/117245494-c88f7080-ae5c-11eb-8e42-1b2bd0c10c95.png)
![1](https://user-images.githubusercontent.com/78661753/117245499-caf1ca80-ae5c-11eb-8019-e3c2a03aefb1.png)



#### Step:4 Create and switched to a new branch
- You got the Branch name, then you need to create and move into a new git branch.
- To create and move you need to use this down command
`git checkout -b welcome-section-dynamic` 
###### Here welcome-section-dynamic is use as example.
![2](https://user-images.githubusercontent.com/78661753/117245553-dd6c0400-ae5c-11eb-9216-741e82bd8c48.PNG)

- Then you will see that git switched to a new branch.
![3](https://user-images.githubusercontent.com/78661753/117245561-e0ff8b00-ae5c-11eb-81fa-9f9e798d2bbc.png)

#### Step:5 Commit and push updated code into Git.
- After switched to a new branch you need to type `git add .` to add all your updated code into git
![4](https://user-images.githubusercontent.com/78661753/117245572-e4931200-ae5c-11eb-8eed-a07737077167.png)

- Then you need to make a commit. In the commit, you need to mention your update.
Here is an example: `git commit -m "devxhub-#173-welcome-section-dynamic:almost done without image delete"`
![5](https://user-images.githubusercontent.com/78661753/117245588-e8269900-ae5c-11eb-8b55-2f88f449187f.png)

If this commits successfully you get that updated information.
Here is an example of terminal output.
![6](https://user-images.githubusercontent.com/78661753/117245598-eb218980-ae5c-11eb-860d-dc02e2ada4db.png)

- After a successful commit you need to push all code into git.
- To push code into git you need to use `git push`. there you will get the upstream link
![7](https://user-images.githubusercontent.com/78661753/117245616-f07ed400-ae5c-11eb-9cf2-dd9551b4269a.png)

- And then use upstream link to get git branch link.
Here is an example code: `git push --set-upstream origin welcome-section-dynamic`
- Then you will get the github branch pull link
![8](https://user-images.githubusercontent.com/78661753/117245627-f4125b00-ae5c-11eb-87d1-ab818b2e17b7.png)



#### Step:6 Merge pull request with the default branch
- Then you need to open the github pull link. in the write input box you need to provide the trello card link.
- Then you need to select the labels, And need to click on the create pull request.
![9](https://user-images.githubusercontent.com/78661753/117245645-fa083c00-ae5c-11eb-843d-2c50aea2de9a.png)

- And after that You need to click the Merge pull Request.
![10](https://user-images.githubusercontent.com/78661753/117245659-fffe1d00-ae5c-11eb-8b24-060b288a8c7f.png)

- And at last you need to Confirm merge. And then it will confirm the merge. 
![11](https://user-images.githubusercontent.com/78661753/117245673-068c9480-ae5d-11eb-8735-924e2eac43f7.png)

#### Step:7 Delete last created branch
- After successfully create the pull and merge, Then you can delete the branch.
![12](https://user-images.githubusercontent.com/78661753/117245719-173d0a80-ae5d-11eb-9ad0-f1cb367f215a.png)
