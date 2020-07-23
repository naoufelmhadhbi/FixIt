import {Component, OnInit} from '@angular/core';
import {Publication} from '../../Model/Publication';
import {PublicationService} from '../../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-cloturer-projet',
  templateUrl: './cloturer-projet.component.html',
  styleUrls: ['./cloturer-projet.component.css']
})
export class CloturerProjetComponent implements OnInit {
  private publications: Publication[] = [];
  displayedColumns: string[] = ['id', 'titre', 'detail', 'etat', 'action'];
  accepted = false;

  constructor(private publicationService: PublicationService, private router: Router) {
    this.publicationService.getPublicationParEtat('In progress').subscribe((data) => {
      this.publications = data;
    });
  }

  ngOnInit() {
  }

  cloturer(idpub) {
    this.publicationService.cloturer(idpub).subscribe((data) => {
      this.publications = data;
    });
    this.accepted = true;
    location.reload();
  }

}
