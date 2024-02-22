![1](https://github.com/HassanDev13/factory/assets/48941486/8304ba0b-af52-4d36-8fee-8dd95901aee4)

# Fire's up on our Telegram Bot 🔥🔥
it's the finall version of our Telegram Bot API integrated in a todo App, take a look on. 

## Welcome again in our ToDo App!

### What is it?
Our application seamlessly blends the power of a ToDo list with the convenience of Telegram messaging. With our innovative integration, managing your tasks has never been easier.

### Why use our app?
- **Effortless Task Management**: Add, update, and delete tasks with ease, all within the user interface.
- **Stay Organized Anywhere**: Access your ToDo list from anywhere.
- **Real-time Notifications**: Receive instant updates on your tasks directly in Telegram, ensuring you never miss an important deadline.

### What's new in this version?
In this latest version of our app, we've revamped the way our Telegram bot interacts with users. Instead of handling individual tasks, the bot now serves as a conduit for communication between users and our backend PHP server. This allows for a smoother user experience and greater flexibility in managing tasks.

### How does it work?
1. **User Interaction**: Use our intuitive Telegram bot interface to add, update, or delete tasks.
2. **Bot Data Management**: The Telegram bot collects user data and forwards it to our backend PHP file, where it is securely stored.
3. **Task Distribution**: When a new task is added, our backend PHP file sends it through the Telegram API to all registered users, ensuring everyone stays up-to-date.

### Get Started!
Ready to experience the future of task management? Follow these simple steps to get started:
1. **Clone the Repository**: `git clone https://github.com/Abdessamed2002/Bot-ToDoApp.git`
2. **Install Dependencies**: `npm install node-telegram-bot-api`
3. **Configure the Bot**: Set up your Telegram bot and configure the webhook URL to point to your backend PHP file.
4. **Run the App**: `npm start`
5. **Start Managing Tasks**: Add, update, or delete tasks through the Telegram bot interface and watch as they seamlessly sync across all your devices.




**1) create you're own bot and get the token from the botFather**

Go to your telegram and type on the serch : BotFather

1) Click on start

2) Type the command '/newbot'

3) Type the name of your bot e.g :    HappyBot

4) Then type a unique username of you're bot like :    my_happy_bot          (it must ended with the word 'bot')

5) After the bot father will provide you a token for you're bot like this : 68********:AAH#####################Gw                       keep the key private :)

NOW your bot is ready to test it let's go to the implementation side :

**Implementation : 2) set up you're envirenment and pull the repository, then install : node-telegram-bot-api**

Create a new folder e.g "myApp" for the app

Open the folder on VScode and run on the terminal

```bash
git init
```

Clone the bot repository
```bash
git clone https://github.com/Abdessamed2002/Bot-ToDoApp.git
```

Install node modules
```bash
npm install node-telegram-bot-api
```

Now In the bot.js code replace the botToken with your key provided from botFather "68********:AAH#####################Gw"

**3) run the bot on you're terminal : node bot.js**
```bash
node bot.js
```


**4) you should have XAMPP or another local web server envirenment to lunch**
![cap2](https://github.com/Abdessamed2002/ToDoAppBot/assets/157251900/b10a6f84-3ad0-4c97-995c-95e77ab2711a)

**5) lunch you're app on you're local bowser**
```bash
localhost/php/myApp/Bot-ToDoApp/index.php
```

The App should be lunched now, then go to you're telegram account and send to the bot start command '/start'
search for you're bot by the username :
![cap3](https://github.com/Abdessamed2002/ToDoAppBot/assets/157251900/76c0e843-9e79-4ea2-9d2c-a05eb25dae2e)


type /start and it will send you welcome!

### D'ont need the bot anymore after that the users data is on the database. 
Turn of the bot 
```bash
ctrl + c
```

now go to the app and make some tasks like this : 
![cap](https://github.com/Abdessamed2002/ToDoAppBot/assets/157251900/b3d2fe18-45a5-4a90-8975-2bebe8eedd37)

# AND FINALY THAT WOULD BE THE RESULT
![cap4](https://github.com/Abdessamed2002/ToDoAppBot/assets/157251900/1971ceb4-0357-4995-8a80-c90b128c711e)



### Contributing
We welcome contributions from developers of all skill levels. Whether you're fixing bugs, adding features, or improving documentation, your contributions are invaluable to us.




**Stay organized, stay productive with our Telegram Bot Integrated ToDo App!**
