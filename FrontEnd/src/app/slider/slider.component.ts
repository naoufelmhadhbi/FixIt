import {Component, OnInit} from '@angular/core';
import {FeedBackService} from '../../Services/FeedBack/feed-back.service';
import {FeedBack} from '../Model/FeedBack';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";

@Component({
  selector: 'app-slider',
  templateUrl: './slider.component.html',
  styleUrls: ['./slider.component.css']
})
export class SliderComponent implements OnInit {

  feedBackList: FeedBack [] = [];
  user: User ;
  constructor(private feedBackService: FeedBackService, private  authentificationService: AuthentificationServiceService) {
  }

  ngOnInit() {
    debugger
    console.log('taaaaw');
    this.feedBackService.getBestProfRate().subscribe(data => {
      console.log(data)
      this.feedBackList = data;
      console.log("yes ddcdc " + this.feedBackList[0].idprofessionnel);
    });

  }

  showBestProf() {
    return this.feedBackService.getBestProfRate().subscribe(data => {
      console.log(data)
      this.feedBackList = data;
      console.log("yes ddcdc " + this.feedBackList);
    });
  }

  getarray(numberStar) {
    console.log('ssssssssss ' + parseInt(numberStar));
    return new Array(parseInt(numberStar));
  }

  getProfNameById(idProf) {
    this.authentificationService.getUserById(idProf).subscribe(data => {
      console.log('name is ' + this.user.username);
      this.user = data;
      return this.user.username ;
      // console.log('name is ' + this.user.username);
    });
  }

}
