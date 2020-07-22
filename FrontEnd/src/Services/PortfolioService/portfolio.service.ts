import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from '../../app/Model/user/User';
import {Observable} from 'rxjs';
import {Publication} from '../../app/Model/Publication';
import {Portfolio} from '../../app/Model/Portfolio';
import {Deplacement} from '../../app/Model/Deplacement';
import {Metier} from '../../app/Model/Metier';

@Injectable({
  providedIn: 'root'
})
export class PortfolioService {

  host = 'http://localhost:8000';
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
  private portfolio: Portfolio[];

  constructor(private http: HttpClient) {
  }


  /*getByUsr(): Observable<Publication>{
    if(this.username == undefined || this.username == null)
      this.username = this.getUsernameFromToken(localStorage.getItem('JwtToken'));
    return this.http.get<Publication>(this.host + '/getByUsername/' + this.username);
  }*/


  getimages(id: number): Observable<Portfolio[]> {
    return this.http.get<Portfolio[]>(this.host + `/portfolio/getImages/${id}`);
  }

  getimageById(id: number): Observable<Portfolio[]> {
    return this.http.get<Portfolio[]>(this.host + `/portfolio/getImageById/${id}`);
  }

  getdeplacementById(id: number): Observable<Deplacement[]> {
    return this.http.get<Deplacement[]>(this.host + `/portfolio/getDepById/${id}`);
  }
  getmetierById(id: number): Observable<Metier[]> {
    return this.http.get<Metier[]>(this.host + `/portfolio/getMetById/${id}`);
  }

  getdeplacements(id: number): Observable<Deplacement[]> {
    return this.http.get<Deplacement[]>(this.host + `/portfolio/getDeplacement/${id}`);
  }

  getmetiers(id: number): Observable<Metier[]> {
    return this.http.get<Metier[]>(this.host + `/portfolio/getMetier/${id}`);
  }

  getAllDeplacements(): Observable<Deplacement[]> {
    return this.http.get<Deplacement[]>(this.host + `/portfolio/getDeplacements`);
  }

  getAllMetiers(): Observable<Metier[]> {
    return this.http.get<Metier[]>(this.host + `/portfolio/getMetiers`);
  }

  deleteImage(id: number) {
    return this.http.delete(this.host + `/portfolio/deleteImage/${id}`);
  }

  addImage(id: number, name, desc): Observable<any> {
    let jsn = {
      'image': name,
      'description': desc
    };
    return this.http.post(this.host + `/portfolio/addImage/${id}`, jsn, this.optionsRegister);
  }

  updateImage(id: number, name, desc): Observable<any> {
    let jsn = {
      'image': name,
      'description': desc
    };
    return this.http.put(this.host + `/portfolio/editImage/${id}`, jsn, this.optionsRegister);
  }

  addDeplacement(idProf: number, idDep: number): Observable<any> {

    return this.http.post(this.host + `/portfolio/addDeplacement/${idProf}/${idDep}`, this.optionsRegister);
  }

  addmetier(idProf: number, idMetier: number): Observable<any> {

    return this.http.post(this.host + `/portfolio/addMetier/${idProf}/${idMetier}`, this.optionsRegister);
  }

  deleteDeplacement(idProf: number, idDep: number) {
    return this.http.delete(this.host + `/portfolio/deleteDeplacement/${idProf}/${idDep}`);
  }

  deleteMetier(idProf: number, idMetier: number) {
    return this.http.delete(this.host + `/portfolio/deleteMetier/${idProf}/${idMetier}`);
  }

  updateDeplacement(idProf: number, idDepOld: number, idDepNew: number) {
    let jsn = {

    };
    return this.http.put(this.host + `/portfolio/UpdateDeplacement/${idProf}/${idDepOld}/${idDepNew}`, jsn, this.optionsRegister);
  }
  updateMtier(idProf: number, idMetOld: number, idMetNew: number) {
    let jsn = {

    };
    return this.http.put(this.host + `/portfolio/Updatemetier/${idProf}/${idMetOld}/${idMetNew}`, jsn, this.optionsRegister);
  }

}
