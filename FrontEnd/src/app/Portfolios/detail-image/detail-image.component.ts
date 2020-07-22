import {Component, Input, OnInit} from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {Router} from '@angular/router';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {User} from '../../Model/user/User';
import {Portfolio} from '../../Model/Portfolio';

@Component({
  selector: 'app-detail-image',
  templateUrl: './detail-image.component.html',
  styleUrls: ['./detail-image.component.css']
})
export class DetailImageComponent implements OnInit {

  @Input() PortToDetail;
  user: User = null;
  private images: Portfolio[] = [];

  constructor(
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router) {
  }

  ngOnInit() {
  }

  delete() {
    this.portfolioservice.deleteImage(this.PortToDetail.id).subscribe(
      (response) => {
        // location.reload();
        //  this.PortToDetail = null;
        // this.router.navigate(['/portfolio']);
        this.router.navigateByUrl('/DetailImage', {skipLocationChange: true}).then(() => {
          this.router.navigate(['/portfolio']);
        });
      },
      (error) => {
        console.log(error);
      }
    );


  }

  Modifier(id) {
    const link = ['/UpdateImage', id];
    this.router.navigate(link);
  }

}
