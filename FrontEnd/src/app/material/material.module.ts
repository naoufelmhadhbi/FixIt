import {NgModule} from '@angular/core';
import {MatButtonModule} from '@angular/material/button';
import {MatStepperModule} from '@angular/material/stepper';
import {MatInputModule} from '@angular/material/input';
import {MatDatepickerModule} from '@angular/material/datepicker';
import {MatNativeDateModule} from '@angular/material/core';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';
import {MatDividerModule} from '@angular/material/divider';
import {MatTableModule} from '@angular/material/table';
import {MatCardModule} from '@angular/material/card';
import {MatChipsModule} from '@angular/material/chips';



const MaterilaComponents = [
  MatButtonModule,
  MatStepperModule,
  MatInputModule,
  MatDatepickerModule,
  MatNativeDateModule,
  MatProgressSpinnerModule,
  MatDividerModule,
  MatTableModule,
  MatCardModule,
  MatChipsModule
];

@NgModule({
  imports: [MaterilaComponents],
  exports: [MaterilaComponents]
})
export class MaterialModule {
}
