import { NgModule } from '@angular/core';
import {MatButtonModule} from '@angular/material/button';
import {MatStepperModule} from '@angular/material/stepper';
import {MatInputModule} from '@angular/material/input';
import {MatDatepickerModule} from '@angular/material/datepicker';

const MaterilaComponents = [
  MatButtonModule,
  MatStepperModule,
  MatInputModule,
  MatDatepickerModule
];

@NgModule({
  imports: [MaterilaComponents],
  exports: [MaterilaComponents]
})
export class MaterialModule { }
