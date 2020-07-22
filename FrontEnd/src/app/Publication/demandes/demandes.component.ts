import { Component, OnInit } from '@angular/core';
import {Publication} from '../../Model/Publication';
import {PublicationService} from '../../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-demandes',
  templateUrl: './demandes.component.html',
  styleUrls: ['./demandes.component.css']
})
export class DemandesComponent implements OnInit {

  private publications: Publication[] = [];
  displayedColumns: string[] = ['id', 'titre', 'detail', 'etat'];

  constructor(private publicationService: PublicationService, private router: Router) {
  }

  ngOnInit() {

    this.publicationService.getAllPublication().subscribe((data) => {
      this.publications = data;
    });

    // console.log(this.publications);
  }

  click() {
    // this.publicationService.getAllPublication().subscribe((data) => {
    //   this.publications = data;
    // });

    console.log(this.publications);
  }

}
