import { Injectable } from '@angular/core';
import {User} from "../../app/Model/user/User";
import {HttpClient,HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {Message} from "../../app/Model/Message";
import {MessageVu} from "../../app/Model/MessageVu";

@Injectable({
  providedIn: 'root'
})
export class MessagerieService {

  host: string = 'http://localhost:8000';
  optionsMessagePost = {
    headers: new HttpHeaders().set('Content-Type', 'application/json')
  };

  private listUsers: User[];
  private message : Message[];

  constructor(private http: HttpClient) { }

  getAllMessage(): Observable<User[]>{
    return this.http.get<User[]>(this.host + '/getAllProfessionnel');
  }

  getAllMessageFromDemandeur(): Observable<User[]>{
    return this.http.get<User[]>(this.host + '/getAllDemandeur');
  }

  getMessageUser(idDemandeur , idProf):Observable<Message[]>{
    console.log("idedemandd " + idDemandeur)
    return this.http.get<Message[]>(this.host + '/getMessagesByUser?id_demandeur='+idDemandeur+'&id_professionnel='+idProf);
  }

  sendMessage(message,idDemandeur,idProfessionnel,from){
    let jsn =  {
      "message" : message,
      "id_demandeur" : idDemandeur ,
      "id_professionnel" : idProfessionnel,
      "messagefrom" : from,
      "vu" : "0"
    };
    console.log('in app' + JSON.stringify(jsn));
    return this.http.post(this.host + '/msg/sendMessage',jsn,this.optionsMessagePost);
  }

  getUserViewNbr(idDemandeur , idProf):Observable<MessageVu[]>{
    console.log("idedemandd " + idDemandeur)
    return this.http.get<MessageVu[]>(this.host + '/countNbrVuByUser?id_demandeur='+idDemandeur+'&id_professionnel='+idProf);
  }

  updateVuUser(idDemandeur , idProf){
    return this.http.post(this.host + '/updateVuByUser?id_demandeur='+idDemandeur+'&id_professionnel='+idProf ,null);
  }

}
