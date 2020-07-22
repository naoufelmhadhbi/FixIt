import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from '../../app/Model/user/User';
import {Observable} from 'rxjs';
import {Publication} from '../../app/Model/Publication';
import {Metier} from '../../app/Model/Metier';
import {Router} from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class PublicationService {

  host: string = 'http://localhost:8000/publication';
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

  constructor(private http: HttpClient, private router: Router) {
  }


  /*getByUsr(): Observable<Publication>{
    if(this.username == undefined || this.username == null)
      this.username = this.getUsernameFromToken(localStorage.getItem('JwtToken'));
    return this.http.get<Publication>(this.host + '/getByUsername/' + this.username);
  }*/

  getAllPublication(): Observable<Publication[]> {
    return this.http.get<Publication[]>(this.host + '/pub/' + localStorage.getItem('UserId'));
  }

  getPublicationParEtat(etat): Observable<Publication[]> {
    return this.http.get<Publication[]>(this.host + '/mesdemandes/' + localStorage.getItem('UserId') + '/' + etat);
  }

  accepterPostule(idPub, idProf): Observable<Publication[]> {
    return this.http.get<Publication[]>(this.host + '/updatepub/' + idPub + '/' + idProf);
  }

  getPublicationParMetier(): Observable<Publication[]> {
    return this.http.get<Publication[]>(this.host + '/pubprof/' + localStorage.getItem('UserId'));
  }

  postuler(idPub): Observable<Publication[]> {
    return this.http.post<Publication[]>(this.host + '/addPublication/' + localStorage.getItem('UserId') + '/' + idPub, '');
  }
  mesTraveaux(): Observable<Publication[]> {
    return this.http.get<Publication[]>(this.host + '/mesreponses/' + localStorage.getItem('UserId'));
  }
  addPublication(data) {
    return this.http.post(this.host + '/new', data, this.optionsRegister);
  }
  metiers(): Observable<Metier[]> {
    return this.http.get<Metier[]>(this.host + '/metier/all');
  }
  cloturer(idPub): Observable<Publication[]> {
  return this.http.post<Publication[]>(this.host + '/cloturer/' + idPub, '');
  this.router.navigateByUrl('/cloturerProjet', { skipLocationChange: true }).then(() => {
      this.router.navigate(['/cloturerProjet']);
    });
}
}
