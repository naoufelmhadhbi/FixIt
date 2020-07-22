import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserProfileComponent} from '../user-profile/user-profile.component';
import {UserInterfaceComponent} from '../user-interface/user-interface.component';
import {MessagerieComponent} from '../messagerie/messagerie.component';
import {RouterModule, Routes} from '@angular/router';
import {AccueilComponent} from '../accueil/accueil.component';
import {PublicationsComponent} from '../publications/publications.component';
import {PortfolioComponent} from '../Portfolios/portfolio/portfolio.component';
import {ListImageComponent} from '../Portfolios/list-image/list-image.component';
import {AddImageComponent} from '../Portfolios/add-image/add-image.component';
import {DeplacementComponent} from '../Deplacements/deplacement/deplacement.component';
import {ReclamationComponent} from '../reclamation/reclamation.component';
import {DetailImageComponent} from '../Portfolios/detail-image/detail-image.component';
import {AddDeplacementComponent} from '../Deplacements/add-deplacement/add-deplacement.component';
import {ListDeplacementComponent} from '../Deplacements/list-deplacement/list-deplacement.component';
import {UpdateImageComponent} from '../Portfolios/update-image/update-image.component';
import {UpdateDeplacementComponent} from '../Deplacements/update-deplacement/update-deplacement.component';
import {MetierComponent} from '../Metiers/metier/metier.component';
import {AddMetierComponent} from '../Metiers/add-metier/add-metier.component';
import {UpdateMetierComponent} from '../Metiers/update-metier/update-metier.component';
import {ListMetierComponent} from '../Metiers/list-metier/list-metier.component';

const routes: Routes = [
  {
    path: '', component: UserInterfaceComponent,
    children: [
      {path: 'messagerie', component: MessagerieComponent},
      {path: 'userProfile', component: UserProfileComponent},
      {path: 'publications', component: PublicationsComponent},
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
