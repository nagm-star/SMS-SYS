export  default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }
    isUser(){
        return this.user.type === 'user';
    }

    isAdminOrAuthor(){
        if(this.user.type === 'admin'|| this.user.type === 'author'){
            return true;
        }
    }
    isAuthorOrUser(){
        if(this.user.type === 'admin'|| this.user.type === 'author'){
            return true;
        }
    }

}

// every class in java script must have constructor
