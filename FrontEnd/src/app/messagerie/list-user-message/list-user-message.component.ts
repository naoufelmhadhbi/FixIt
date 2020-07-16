import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../../Services/AuthentificationService/authentification-service.service";
import {User} from "../../Model/user/User";
import {MessagerieService} from "../../../Services/MessagerieService/messagerie.service";

@Component({
  selector: 'app-list-user-message',
  templateUrl: './list-user-message.component.html',
  styleUrls: ['./list-user-message.component.css']
})
export class ListUserMessageComponent implements OnInit {
  color : string = "red" ;
  showMessageList : boolean ;
  user : User;
  userMessage : User ;
  listeUser : User [] = [] ;
  isProfessionnel : boolean = false ;
  constructor(private authService: AuthentificationServiceService,private messageService : MessagerieService) { }

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      this.isProfessionnel = this.user.type == 'professionnel' ;
      if(!this.isProfessionnel)
        this.getListProfMessage();
      else
        this.getListDemandMessage();
    });

  }

  showMsgList(user : User){
    this.showMessageList = true ;
    this.userMessage = user ;
  }

  getListProfMessage(){
    console.log('this ius ' + this.user);
    this.messageService.getAllMessage().subscribe((data) => {
      this.listeUser = data;
    });
  }

  getListDemandMessage(){
    console.log('this ius ' + this.user);
    this.messageService.getAllMessageFromDemandeur().subscribe((data) => {
      this.listeUser = data;
    });
  }




}
