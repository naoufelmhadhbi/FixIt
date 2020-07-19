import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class FeedBackService {

  host: string = 'http://localhost:8000';

  optionsRegister = {
    headers: new HttpHeaders().set('Content-Type', 'application/json')
  };

  constructor(private http: HttpClient) { }

  saveFeedBack(data,idProf){
    return this.http.post(this.host + '/addFeedback/'+idProf , data, this.optionsRegister);
  }
}
