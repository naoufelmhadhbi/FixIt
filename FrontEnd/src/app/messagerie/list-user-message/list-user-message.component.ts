import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {User} from "../../Model/user/User";
import {MessagerieService} from "../../../Services/MessagerieService/messagerie.service";
import { MessageVu } from 'src/app/Model/MessageVu';

@Component({
  selector: 'app-list-user-message',
  templateUrl: './list-user-message.component.html',
  styleUrls: ['./list-user-message.component.css']
})
export class ListUserMessageComponent implements OnInit {
  color = "red" ;
  showMessageList : boolean ;
  user : User;
  userMessage : User ;
  listeUser : User [] = [] ;
  isProfessionnel : boolean = false ;
  messageVu : MessageVu [] = [] ;
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
    this.messageService.updateVuUser(11,12).subscribe((data) => {});
  }

  showMsgList2(user : User){
    //this.messageService.updateVuUser(11,12).subscribe((data) => {});
    //this.messageVu = [];
    this.showMessageList = true ;
    this.userMessage = user ;
    if(this.isProfessionnel)
      this.messageService.updateVuUser(user.id,this.user.id).subscribe((data) => {});
    else
      this.messageService.updateVuUser(this.user.id,user.id).subscribe((data) => {});  

    this.messageVu.forEach((ele) => {
        if(ele.userInfo.id == user.id)
            ele.nbrvu = "0" ;
    });
    //this.getListDemandMessage();
  }

  getListProfMessage(){
    console.log('this ius ' + this.user);
    this.messageService.getAllMessage().subscribe((data) => {
      this.listeUser = data;
      this.listeUser.forEach((ele) => {
        this.messageService.getUserViewNbr(this.user.id,ele.id).subscribe(data => {
            let mg : MessageVu = {nbrvu: '0' , userInfo: this.user} ;
            //this.messageVu = data;
            let messageVis: MessageVu[] = data;
            mg.userInfo = ele
            mg.nbrvu = messageVis[0].nbrvu ;
            this.messageVu.push(mg);
            
        })
      });
    });
  }

  getListDemandMessage(){
    console.log('this ius ' + this.user);
    this.messageService.getAllMessageFromDemandeur().subscribe((data) => {
      this.listeUser = data;
      let i = 0 ;
      this.listeUser.forEach((ele) => {
        this.messageService.getUserViewNbr(ele.id,this.user.id).subscribe(data => {
            let mg : MessageVu = {nbrvu: '0' , userInfo: this.user} ;
            //this.messageVu = data;
            let messageVis: MessageVu[] = data;
            mg.userInfo = ele
            mg.nbrvu = messageVis[0].nbrvu ;
            this.messageVu.push(mg);
            
        })
      });
    });
  }




}
