import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from '../../app/Model/user/User';
import {Observable} from 'rxjs';
import {Publication} from '../../app/Model/Publication';

@Injectable({
  providedIn: 'root'
})
export class PublicationService {

  host: string = 'http://localhost:8000';
  options = {
    headers: new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
  };
  optionsRegister = {
    headers: new HttpHeaders().set('Content-Type', 'application/json')
  };
  body = new URLSearchParams();
  jwt: string;
  username: string;
  roles: Array<string>;
  private publication: Publication[];

  constructor(private http: HttpClient) {
  }


  /*getByUsr(): Observable<Publication>{
    if(this.username == undefined || this.username == null)
      this.username = this.getUsernameFromToken(localStorage.getItem('JwtToken'));
    return this.http.get<Publication>(this.host + '/getByUsername/' + this.username);
  }*/

  getAllPublication(): Observable<Publication[]>{
    return this.http.get<Publication[]>(this.host + '/publication');
  }

}
