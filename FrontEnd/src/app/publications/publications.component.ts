import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from '../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {PublicationService} from '../../Services/PublicationService/publication.service';
import {Publication} from '../Model/Publication';

@Component({
  selector: 'app-publications',
  templateUrl: './publications.component.html',
  styleUrls: ['./publications.component.css']
})
export class PublicationsComponent implements OnInit {
  private publications: Publication[] = [];
  displayedColumns: string[] = ['id', 'titre', 'detail', 'etat'];

  constructor(private publicationService: PublicationService, private router: Router) {
  }

  ngOnInit() {

    this.publicationService.getAllPublication().subscribe((data) => {
      this.publications = data;
    });

    console.log(this.publications);
  }

  click() {
    this.publicationService.getAllPublication().subscribe((data) => {
      this.publications = data;
    });

    console.log(this.publications);
  }

}
