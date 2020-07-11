import { Injectable } from '@angular/core';
import {User} from "../../app/Model/user/User";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Message} from "../../app/Model/Message";

@Injectable({
  providedIn: 'root'
})
export class MessagerieService {

  host: string = 'http://localhost:8000';
  private listUsers: User[];
  private message : Message[];

  constructor(private http: HttpClient) { }

  getAllMessage(): Observable<User[]>{
    return this.http.get<User[]>(this.host + '/getAllProfessionnel');
  }

  getMessageUser(idDemandeur , idProf):Observable<Message[]>{
    console.log("idedemandd " + idDemandeur)
    return this.http.get<Message[]>(this.host + '/getMessagesByUser?id_demandeur='+idDemandeur+'&id_professionnel='+idProf);
  }

}
