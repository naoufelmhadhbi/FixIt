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
      console.log('this.userConnected.type ' + this.userConnected.type);
      if(this.userConnected.type == 'professionnel') {
        this.idDemandeur = this.userConnected.id ;
        this.idProfessionnel = this.filsProperty.id ;
        console.log('not demandeur 1 ' + this.idDemandeur);
        console.log('not prof 1 ' + this.idProfessionnel);
      }
      else {
        this.idDemandeur = this.filsProperty.id;
        this.idProfessionnel = this.userConnected.id ;
        console.log('not demandeur 2 ' + this.idDemandeur);
        console.log('not prof 2 ' + this.idProfessionnel);
      }
      console.log('tijis use   vv ' + this.idDemandeur);
      console.log('idProf ' + this.idProfessionnel);
      this.messageService.getMessageUser(this.idDemandeur,this.idProfessionnel).subscribe((data) => {
        this.messageUser = data;
        console.log('data in msg' + data[0]['message']);
      });
    });

  }

  ngOnChanges(changes: SimpleChanges): void {
    debugger
    this.messageUser = [] ;
    this.idDemandeur = undefined ;
    this.idProfessionnel = undefined ;
    console.log(this.userConnected ? this.userConnected.type : undefined);
    if((this.userConnected ? this.userConnected.type : undefined) == 'professionnel') {
      this.idDemandeur = (this.userConnected ? this.userConnected.id : undefined) ;
      this.idProfessionnel = this.filsProperty.id ;
      console.log('not demandeur 1 ' + this.idDemandeur);
      console.log('not prof 1 ' + this.idProfessionnel);
    }
    else {
      this.idDemandeur = this.filsProperty.id;
      this.idProfessionnel = (this.userConnected ? this.userConnected.id : undefined) ;
      console.log('not demandeur 2 ' + this.idDemandeur);
      console.log('not prof 2 ' + this.idProfessionnel);
    }
    this.messageService.getMessageUser(this.idDemandeur,this.idProfessionnel).subscribe((data) => {
      console.log('in data de' + this.idDemandeur);
      console.log('in data prof' + this.idProfessionnel);
      this.messageUser = data;
      console.log('data in msg' + data[0]['message']);
    });
  }

  sendMessage(message){
      this.testmsg.push(message.value);
  }

  isProfessionnel(){
    return this.userConnected.type == 'professionnel' ;
  }


}
