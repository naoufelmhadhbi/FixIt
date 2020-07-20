import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable} from "rxjs";
import {User} from "../../app/Model/user/User";
import {FeedBack} from "../../app/Model/FeedBack";

@Injectable({
  providedIn: 'root'
})
export class FeedBackService {

  host: string = 'http://localhost:8000';

  optionsRegister = {
    headers: new HttpHeaders().set('Content-Type', 'application/json')
  };

  constructor(private http: HttpClient) {
  }

  saveFeedBack(data, idProf) {
    return this.http.post(this.host + '/addFeedback/' + idProf, data, this.optionsRegister);
  }

  getBestProfRate(): Observable<FeedBack[]> {
    return this.http.get<FeedBack[]>(this.host + '/getMoyenneProf');
  }
}
