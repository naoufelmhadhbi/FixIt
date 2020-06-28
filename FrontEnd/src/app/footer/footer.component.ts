import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";


@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService) { }

  ngOnInit() {
  }

  onlogin(data) {
    console.log('this data ' + data['username']);
    this.authService.login(data).subscribe(resp => {
      console.log(data);
    }) ;

  }

}
