import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";
import {Router} from "@angular/router";
import {FeedBackService} from "../../Services/FeedBack/feed-back.service";

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService , private router: Router , private feedBackService : FeedBackService) {
    debugger
    //if(localStorage.getItem('JwtToken') == null || localStorage.getItem('JwtToken') == undefined)
    //this.router.navigate(['/acceuil']);
  }
  color1 :string = "#cccccc";
  color2 :string = "#cccccc" ;
  color3 :string = "#cccccc" ;
  color4 :string = "#cccccc" ;
  color5 :string = "#cccccc" ;

  username: string;
  comment: string ;
  rate: number ;
  user: User;

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
    })
  }

  isProfessionnel() {
    return this.user.type == 'professionnel' ;
  }

  starClick(vl){
    this.rate = vl ;
    switch(vl) {
      case 1 : {
        this.color1 = "orange" ;
        this.color2 = "#cccccc" ;
        this.color3 = "#cccccc" ;
        this.color4 = "#cccccc" ;
        this.color5 = "#cccccc" ;
        break;
      }
      case 2 : {
        this.color1 = "orange" ;
        this.color2 = "orange" ;
        this.color3 = "#cccccc" ;
        this.color4 = "#cccccc" ;
        this.color5 = "#cccccc" ;
        break;
      }
      case 3 : {
        this.color1 = "orange" ;
        this.color2 = "orange" ;
        this.color3 = "orange" ;
        this.color4 = "#cccccc" ;
        this.color5 = "#cccccc" ;
        break;
      }
      case 4 : {
        this.color1 = "orange" ;
        this.color2 = "orange" ;
        this.color3 = "orange" ;
        this.color4 = "orange" ;
        this.color5 = "#cccccc" ;
        break;
      }
      case 5 : {
        this.color1 = "orange" ;
        this.color2 = "orange" ;
        this.color3 = "orange" ;
        this.color4 = "orange" ;
        this.color5 = "orange" ;

        break;
      }
    }
  }

  saveFeedBack(idProf){
    alert('rate is ' + this.rate + 'comment is ' + this.comment);
    let jsn =  {
      "avis" : this.comment,
      "recommandation" : this.rate
    };
    this.feedBackService.saveFeedBack(jsn,idProf).subscribe(data => {
      console.log('feedBack ' + data[0]);
    });
  }

}
