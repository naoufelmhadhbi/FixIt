import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import * as jwt_decode from 'jwt-decode';
import {User} from "../../app/Model/user/User";
import {Observable} from 'rxjs';


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
  private user: User;

  constructor(private http: HttpClient) {
  }

  login(data) {
    console.log('user IS ' + data['username'] + ' Pass IS ' + data['password']);
    return this.http.post(this.host + '/api/login_check', 'username=' + data['username'] + '&password=' + data['password'], this.options);
  }

  register(data) {
    console.log('user IS ' + data['username'] + ' Pass IS ' + data['password']);
    return this.http.post(this.host + '/add', 'username=' + data['username'] + '&password=' + data['password'] + '&type=' + data['type'] + '&email' + data['email'], this.options);
  }

  saveToken(token: string) {
    localStorage.setItem('JwtToken', token);
    this.jwt = token;
    this.decodeJwt(token);
  }

  decodeJwt(token) {
    var decoded = jwt_decode(token);
    console.log(decoded);
    this.username = decoded['username'];
    this.roles = decoded['roles'];
    console.log('uuuuuuuser' + this.username + this.roles)
  }

  getUsernameFromToken(token){
    var decoded = jwt_decode(token);
     return decoded['username'];
  }

  isAdmin() {
    return this.roles != undefined && this.roles.indexOf('ADMIN') > 0;
  }

  isUser() {
    return this.roles != undefined && this.roles.indexOf('USER') > 0;
  }

  isAuthenticated() {
    console.log('role is ' + this.roles + ' isAdmin ' + this.isAdmin());
    this.jwt = localStorage.getItem('JwtToken');
    if (this.jwt != null && this.jwt != undefined)
      this.decodeJwt(this.jwt);
    return this.roles != undefined;
  }

  logout() {
    localStorage.removeItem('JwtToken');
    this.username = undefined;
    this.jwt = undefined;
    this.roles = undefined;
  }

  getUserByUsername() {
    this.http.get(this.host + '/getByUsername/' + this.username).subscribe((data : User) => {
      console.log(data);
      console.log(data[0]['username']);
      //this.user.username = data[0]['username'] ;
      // this.user.type = data[0]['type'] ;
      // this.user.email = data[0]['email'] ;
      // this.user.sexe = data[0]['sexe'] ;
      //console.log("user   est "+this.user);
    });
    return this.user ;
  }

  getByUsr(): Observable<User>{
    if(this.username == undefined || this.username == null)
      this.username = this.getUsernameFromToken(localStorage.getItem('JwtToken'));
    return this.http.get<User>(this.host + '/getByUsername/' + this.username);
  }

}
