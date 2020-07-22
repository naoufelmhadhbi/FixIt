import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CloturerProjetComponent } from './cloturer-projet.component';

describe('CloturerProjetComponent', () => {
  let component: CloturerProjetComponent;
  let fixture: ComponentFixture<CloturerProjetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CloturerProjetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CloturerProjetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
