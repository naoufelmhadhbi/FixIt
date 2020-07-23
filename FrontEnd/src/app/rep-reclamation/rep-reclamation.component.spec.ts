import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RepReclamationComponent } from './rep-reclamation.component';

describe('RepReclamationComponent', () => {
  let component: RepReclamationComponent;
  let fixture: ComponentFixture<RepReclamationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RepReclamationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RepReclamationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
