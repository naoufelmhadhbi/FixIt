import {Component, OnInit, Input, OnChanges, SimpleChanges} from '@angular/core';
import {User} from "../../Model/user/User";
import {Message} from "../../Model/Message";
import {MessagerieService} from "../../../Services/MessagerieService/messagerie.service";
import {AuthentificationServiceService} from "../../../Services/AuthentificationService/authentification-service.service";


@Component({
  selector: 'app-messagerie',
  templateUrl: './messagerie.component.html',
  styleUrls: ['./messagerie.component.css']
})
export class MessagerieComponent implements OnInit , OnChanges{
  @Input() filsProperty : User;
  messageUser : Message[] = [] ;
  testmsg : string [] = ["yes","ok","accord"];
  userConnected : User ;
   idDemandeur ;
   idProfessionnel ;
  constructor(private messageService : MessagerieService , private authService: AuthentificationServiceService) { }

  ngOnInit() {
    debugger
    console.log("this is parent variable " + this.filsProperty.nom);
    this.authService.getByUsr().subscribe((data) => {
      this.userConnected = data[0];
      this.getConnecterUserMessage(this.userConnected,this.filsProperty);
    });

  }

  ngOnChanges(changes: SimpleChanges): void {
    debugger
    console.log('NgOnInit');
    this.messageUser = [] ;
    this.idDemandeur = undefined ;
    this.idProfessionnel = undefined ;
    console.log(this.userConnected ? this.userConnected.type : undefined);
    this.getConnecterUserMessage(this.userConnected,this.filsProperty);
  }

  sendMessage(message){
      this.testmsg.push(message.value);
      let messageTosend : Message = {idDemandeur : this.idDemandeur,message:message.value,idProfessionnel:this.idProfessionnel,dateEnvoi:new Date().toLocaleTimeString('it-IT').toString(),id:this.userConnected.id,messagefrom:this.userConnected.id.toString(),vu:true};
      alert('eys ' + message.value);
      this.messageService.sendMessage(message.value,this.idDemandeur,this.idProfessionnel,this.userConnected.id).subscribe((data)=>{
        console.log('data insert ' + JSON.stringify(data));
      });;
      messageTosend.message = message.value ;
      console.log('msg is ' + messageTosend.message) ;
      this.messageUser.push(messageTosend);
      document.getElementById('messageInput').value = "" ;
      alert(new Date());
  }

  isProfessionnel(){
    return this.userConnected.type == 'professionnel' ;
  }

  getConnecterUserMessage(userCnx : User, userMsg : User){
    if(userCnx != null && userMsg != undefined){
    console.log('this.userConnected.type ' + userCnx.type);
    if(this.userConnected.type != 'professionnel') {
      this.idDemandeur = userCnx.id ;
      this.idProfessionnel = userMsg.id ;
      console.log('not demandeur 1 ' + this.idDemandeur);
      console.log('not prof 1 ' + this.idProfessionnel);
    }
    else {
      this.idDemandeur = userMsg.id;
      this.idProfessionnel = userCnx.id ;
      console.log('not demandeur 2 ' + this.idDemandeur);
      console.log('not prof 2 ' + this.idProfessionnel);
    }
    console.log('tijis use   vv ' + this.idDemandeur);
    console.log('idProf ' + this.idProfessionnel);
    this.messageService.getMessageUser(this.idDemandeur,this.idProfessionnel).subscribe((data) => {
      this.messageUser = data;
      //this.messageUser[0].dateEnvoi = JSON.stringify(data[0]['dateEnvoi']) ;
      let i = 0 ;
      this.messageUser.forEach((ele) => {
        this.messageUser[i].dateEnvoi = JSON.stringify(data[i]['dateEnvoi']).substr(9,19);
        i ++ ;
      });
    });
  }
}

}
