import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserProfileComponent} from '../user-profile/user-profile.component';
import {UserInterfaceComponent} from '../user-interface/user-interface.component';
import {MessagerieComponent} from '../messagerie/messagerie.component';
import {RouterModule, Routes} from '@angular/router';
import {AccueilComponent} from '../accueil/accueil.component';
import {DemandesComponent} from '../Publication/demandes/demandes.component';
import {DemandesEncoursComponent} from '../Publication/demandes-encours/demandes-encours.component';
import {MesOffresComponent} from '../Publication/mes-offres/mes-offres.component';
import {MesTraveauxComponent} from '../Publication/mes-traveaux/mes-traveaux.component';
import {AddPublicationComponent} from '../Publication/add-publication/add-publication.component';
import {CloturerProjetComponent} from '../Publication/cloturer-projet/cloturer-projet.component';
import {ReclamationComponent} from '../reclamation/reclamation.component';
import {CreateReclamationComponent} from '../create-reclamation/create-reclamation.component';
import {RepReclamationComponent} from '../rep-reclamation/rep-reclamation.component';
import {UserReclamationComponent} from '../user-reclamation/user-reclamation.component';
import {DeplacementComponent} from '../Deplacements/deplacement/deplacement.component';
import {AddDeplacementComponent} from '../Deplacements/add-deplacement/add-deplacement.component';
import {UpdateDeplacementComponent} from '../Deplacements/update-deplacement/update-deplacement.component';
import {ListDeplacementComponent} from '../Deplacements/list-deplacement/list-deplacement.component';
import {MetierComponent} from '../Metiers/metier/metier.component';
import {AddMetierComponent} from '../Metiers/add-metier/add-metier.component';
import {UpdateMetierComponent} from '../Metiers/update-metier/update-metier.component';
import {ListMetierComponent} from '../Metiers/list-metier/list-metier.component';
import {PortfolioComponent} from '../Portfolios/portfolio/portfolio.component';
import {AddImageComponent} from '../Portfolios/add-image/add-image.component';
import {UpdateImageComponent} from '../Portfolios/update-image/update-image.component';
import {DetailImageComponent} from '../Portfolios/detail-image/detail-image.component';

const routes: Routes = [
  {
    path: '', component: UserInterfaceComponent,
    children: [
      {path: 'messagerie', component: MessagerieComponent},
      {path: 'userProfile', component: UserProfileComponent},
      {path: 'mesDemandes', component: DemandesComponent},
      {path: 'mesDemandesEncours', component: DemandesEncoursComponent},
      {path: 'mesOffres', component: MesOffresComponent},
      {path: 'mesTraveaux', component: MesTraveauxComponent},
      {path: 'AddPublication', component: AddPublicationComponent},
      {path: 'cloturerProjet', component: CloturerProjetComponent},
      { path: 'reclamation', component:  ReclamationComponent},
      { path: 'createReclamation', component:  CreateReclamationComponent},
      { path: 'RepRec/:id', component:  RepReclamationComponent},
      { path: 'UserRec', component:  UserReclamationComponent},
      {path: 'deplacement', component: DeplacementComponent},
      {path: 'AddDeplacement', component: AddDeplacementComponent},
      {path: 'UpdateDeplacement/:id', component: UpdateDeplacementComponent},
      {path: 'ListDeplacement', component: ListDeplacementComponent},
      {path: 'metier', component: MetierComponent},
      {path: 'AddMetier', component: AddMetierComponent},
      {path: 'UpdateMetier/:id', component: UpdateMetierComponent},
      {path: 'ListMetier', component: ListMetierComponent},
      {path: 'portfolio', component: PortfolioComponent},
      {path: 'AddImage', component: AddImageComponent},
      {path: 'UpdateImage/:id', component: UpdateImageComponent},
      {path: 'DetailImage', component: DetailImageComponent}

    ]
  },
  {path: 'accueil', component: AccueilComponent}
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ]
})
export class RoutingModule {
}
