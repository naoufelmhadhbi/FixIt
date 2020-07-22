import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DemandesEncoursComponent } from './demandes-encours.component';

describe('DemandesEncoursComponent', () => {
  let component: DemandesEncoursComponent;
  let fixture: ComponentFixture<DemandesEncoursComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DemandesEncoursComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DemandesEncoursComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
