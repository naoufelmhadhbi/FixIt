import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";

class JwtHelperService {
}

@Injectable({
  providedIn: 'root'
})
export class AuthentificationServiceService {

  host: string = 'http://localhost:8000';
  options = {
    headers: new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
  };
  body = new URLSearchParams();
  jwt: string;
  username: string;
  roles: Array<string>;
  private jwtHelper: JwtHelperService;

  constructor(private http: HttpClient) { }

  login(data){
    return this.http.post(this.host + '/api/login_check', 'username=azerty&password=azerty', this.options);
  }

}
