import {ChangeDetectorRef, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {Portfolio} from '../../Model/Portfolio';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {User} from '../../Model/user/User';
// import {FileUploader, FileSelectDirective} from 'ng2-file-upload/ng2-file-upload';
import {FormBuilder} from '@angular/forms';


@Component({
  selector: 'app-portfolio',
  templateUrl: './portfolio.component.html',
  styleUrls: ['./portfolio.component.css']
})
export class PortfolioComponent implements OnInit {



  constructor(private portfolioservice: PortfolioService,
              private authService: AuthentificationServiceService,

  ) {
  }

  private images: Portfolio[] = [];
  photos: Portfolio;
  user: User = null;




  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.GetImages(this.user.id);
    });

    // console.log(this.user.id);
  }



  selectionner(photo) {
    this.photos = photo;
  }

  onFileSelected(event) {
    console.log(event);
  }

  GetImages(id) {
    this.portfolioservice.getimages(id).subscribe((data1) => {
      this.images = data1;

    });
  }

}
