import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import * as jwt_decode from 'jwt-decode';
import {User} from '../../app/Model/user/User';
import {Observable} from 'rxjs';
import {Publication} from '../../app/Model/Publication';


@Injectable({
  providedIn: 'root'
})
export class AuthentificationServiceService {

  host = 'http://localhost:8000';
  options = {
    headers: new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
  };
  optionsRegister = {
    headers: new HttpHeaders().set('Content-Type', 'application/json')
  };
  body = new URLSearchParams();
  jwt: string;
  id: string;
  username: string;
  roles: Array<string>;
  private user: User;
  type: string;

  constructor(private http: HttpClient) {
  }


  login(data) {
    console.log('user IS ' + data['username'] + ' Pass IS ' + data['password']);
    return this.http.post(this.host + '/api/login_check', 'username=' + data['username'] + '&password=' + data['password'], this.options);
  }

  register(data) {
    console.log('user IS ' + data['username'] + ' Pass IS ' + data['password']);
    let jsn = {
      'username': 'sont',
      'password': 'azerty',
      'email': 'Ibenjawballah@spb.eu',
      'type': 'demandeur'
    };
    console.log('JSN ' + jsn);
    console.log('with JSN ' + JSON.stringify(data));
    return this.http.post(this.host + '/add', data, this.optionsRegister);
  }

  saveToken(token: string) {
    localStorage.setItem('JwtToken', token);
    this.jwt = token;
    this.decodeJwt(token);
  }

  saveIdUser() {
    this.getByUsr().subscribe((data) => {
      this.user = data[0];
      console.log(this.user.id);
    });
    localStorage.setItem('UserId', this.user.id.toString());

    // localStorage.setItem('UserId', "aaaaaaaaaaaaa");

  }


  decodeJwt(token) {
    var decoded = jwt_decode(token);
    console.log(decoded);
    this.username = decoded['username'];
    this.roles = decoded['roles'];
    console.log('uuuuuuuser' + this.username + this.roles);
  }

  getUsernameFromToken(token) {
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
    if (this.jwt != null && this.jwt != undefined) {
      this.decodeJwt(this.jwt);
    }
    return this.roles != undefined;
  }

  logout() {
    localStorage.removeItem('JwtToken');
    localStorage.removeItem('UserId');
    this.username = undefined;
    this.jwt = undefined;
    this.roles = undefined;
  }

  getUserByUsername(username): Observable<User> {
    return  this.http.get<User>(this.host + '/getByUsername/' + username);
  }

  getByUsr(): Observable<User> {
    if (this.username === undefined || this.username === null) {
      this.username = this.getUsernameFromToken(localStorage.getItem('JwtToken'));
    }
    return this.http.get<User>(this.host + '/getByUsername/' + this.username);
  }

  getAllUser(): Observable<User> {
    return this.http.get<User>(this.host + '/getAllUsr');
  }

}
