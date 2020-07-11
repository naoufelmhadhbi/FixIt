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
    });

    this.messageService.getAllMessage().subscribe((data) => {
      this.listeUser = data;
    });
  }

  showMsgList(user : User){
    this.showMessageList = true ;
    this.userMessage = user ;
  }




}
