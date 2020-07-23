import {Component, OnInit} from '@angular/core';
import {FeedBackService} from '../../Services/FeedBack/feed-back.service';
import {FeedBack} from '../Model/FeedBack';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";
import {FeedBackProf} from "../Model/FeedBackProf";

@Component({
  selector: 'app-slider',
  templateUrl: './slider.component.html',
  styleUrls: ['./slider.component.css']
})
export class SliderComponent implements OnInit {

  feedBackList: FeedBack [] = [];
  user: User ;
  feedBackProf: FeedBackProf [] = [] ;
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
    this.feedBackService.getFeedBackByUserId(idProf).subscribe(data => {
      this.feedBackProf = data;
      console.log('name is 2' + this.user.username);
    });
  }

}
